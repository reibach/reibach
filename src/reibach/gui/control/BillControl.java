/**********************************************************************
 * $Source: /cvsroot/jameica/jameica_exampleplugin/src/de/willuhn/jameica/example/gui/control/ProjectControl.java,v $
 * $Revision: 1.9 $
 * $Date: 2010-11-09 17:20:16 $
 * $Author: willuhn $
 * $Locker:  $
 * $State: Exp $
 *
 * Copyright (c) by willuhn.webdesign
 * All rights reserved
 *
 **********************************************************************/

package reibach.gui.control;

import java.io.File;
import java.io.FileOutputStream;
import java.io.OutputStream;
import java.rmi.RemoteException;
import java.util.Date;

import org.eclipse.swt.widgets.Event;
import org.eclipse.swt.widgets.Listener;


import reibach.gui.action.PositionDetail;
import reibach.gui.menu.BillListMenu;
import reibach.gui.menu.PositionListMenu;
import reibach.Settings;
import reibach.rmi.Bill;
import reibach.rmi.Customer;

import de.willuhn.datasource.rmi.DBIterator;
import de.willuhn.datasource.rmi.DBService;
import de.willuhn.jameica.gui.AbstractControl;
import de.willuhn.jameica.gui.AbstractView;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.Part;
import de.willuhn.jameica.gui.formatter.CurrencyFormatter;
import de.willuhn.jameica.gui.formatter.DateFormatter;
import de.willuhn.jameica.gui.formatter.Formatter;
import de.willuhn.jameica.gui.input.DateInput;
import de.willuhn.jameica.gui.input.DecimalInput;
import de.willuhn.jameica.gui.input.Input;
import de.willuhn.jameica.gui.input.LabelInput;
import de.willuhn.jameica.gui.input.SelectInput;
import de.willuhn.jameica.gui.input.TextAreaInput;
import de.willuhn.jameica.gui.input.TextInput;
import de.willuhn.jameica.gui.parts.ContextMenuItem;
import de.willuhn.jameica.gui.parts.TablePart;
import de.willuhn.jameica.messaging.StatusBarMessage;
import de.willuhn.jameica.system.Application;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;


/**
 * @author willuhn
 */
public class BillControl extends AbstractControl
{

  // list of all bills
  private TablePart billList;

  // Input fields for the bill attributes,
  private TextInput name;
  private TextAreaInput description;
  private DecimalInput price;
  
  
  // private DateInput startDate;
  private DateInput billDate;

  private LabelInput effortSummary;

	// list of positions contained in this bill
	private TablePart positionList;

    // this is the currently opened bill
    private Bill bill;
    
    
    /** Select fuer customer**/
    private SelectInput customer; 
    
  
  /**
   * ct.
	 * @param view this is our view (the welcome screen).
	 */
	public BillControl(AbstractView view)
	{
		super(view);
	}

  /**
   * Small helper method to get the current bill.
   * @return
   */
  private Bill getBill()
  {
    if (bill != null)
      return bill;
    bill = (Bill) getCurrentObject();
    return bill;
  }

  /**
   * Returns the input field for the bill name.
   * @return input field.
   * @throws RemoteException
   */
  public Input getName() throws RemoteException
  {
    if (name != null)
      return name;
    // "255" is the maximum length for this input field.
    name = new TextInput(getBill().getName(),255);
    name.setMandatory(true);
    name.setName(Settings.i18n().tr("Name"));
    return name;
  }
  
  

  
	/**
	 * Returns a the field to choose the project.
	 * @return the project.
	 * @throws RemoteException
	 */
	public Input getCustomer() throws RemoteException
	{
		if (customer != null)
			return customer;
		
		customer = new SelectInput(Settings.getDBService().createList(Customer.class),getBill().getCustomer());
		customer.setName(Settings.i18n().tr("Customer"));
		customer.setMandatory(true);
		return customer;
	}

  
  /**
   * Returns the input field for the bill description.
   * @return input field.
   * @throws RemoteException
   */
  public Input getDescription() throws RemoteException
  {
    if (description != null)
      return description;
    description = new TextAreaInput(getBill().getDescription());
    description.setName("");
    return description;
  }

  /**
   * Returns the input field for the bill price.
   * @return input field.
   * @throws RemoteException
   */
  public Input getPrice() throws RemoteException
  {

	  if (price != null)
	      return price;
	    
	  
	if (price != null)
      return price;
    price = new DecimalInput(getBill().getPrice(), Settings.DECIMALFORMAT);
    price.setComment(Settings.i18n().tr("{0} per Hour",Settings.CURRENCY));
    price.setName(Settings.i18n().tr("Price"));
    
    // if we change the price, we have to refresh the summary
    price.addListener(new Listener() {
      public void handleEvent(Event event)
      {
        try
        {
          Double d = (Double) getPrice().getValue();
          if (d == null)
            return;
          
          double p = d.doubleValue();
          if (Double.isNaN(p))
            return;
          
          double effort = getBill().getEfforts();
          double sum = effort * p;
          
          getEffortSummary().setValue(Settings.DECIMALFORMAT.format(sum));
        }
        catch (Exception e)
        {
          Logger.error("error while calculating sum",e);
          Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Error while calculating summary: {0}",e.getMessage()),StatusBarMessage.TYPE_ERROR));
        }
      }
    });
    return price;
  }


  
  /**
   * Returns the input field for the end date.
   * @return input field.
   * @throws RemoteException
   */
  public Input getBillDate() throws RemoteException
  {
    if (billDate != null)
      return billDate;
    
    billDate = new DateInput(getBill().getBillDate(),Settings.DATEFORMAT);
    billDate.setName(Settings.i18n().tr("Bill date"));
    return billDate;
  }

 

	/**
	 * Returns a text label that contains the summary of all efforts in this bill.
   * @return label.
   * @throws RemoteException
   */
  public Input getEffortSummary() throws RemoteException
	{
		if (effortSummary != null)
			return effortSummary;

    double effort = getBill().getEfforts();
    double sum = effort * getBill().getPrice();

    effortSummary = new LabelInput(Settings.DECIMALFORMAT.format(sum));
    effortSummary.setName(Settings.i18n().tr("Efforts"));
    effortSummary.setComment(Settings.i18n().tr("{0} [{1} Hours]",Settings.CURRENCY,Settings.DECIMALFORMAT.format(effort)));
		return effortSummary;
	}

  /**
   * Creates a table containing all bills.
   * @return a table with bills.
   * @throws RemoteException
   */
  public Part getBillsTable() throws RemoteException
  {
    // do we have an allready created table?
    if (billList != null)
      return billList;
   
    // 1) get the dataservice
    DBService service = Settings.getDBService();
    
    // 2) now we can create the bill list.
    //    We do not need to specify the implementing class for
    //    the interface "Bill". Jameicas Classloader knows
    //    all classes an finds the right implementation automatically. ;)
    DBIterator bills = service.createList(Bill.class);
    
    // 4) create the table
    billList = new TablePart(bills,new reibach.gui.action.BillDetail());

    // 5) now we have to add some columns.
    billList.addColumn(Settings.i18n().tr("Name of bill"),"name"); // "name" is the field name from the sql table.

    // 6) the following fields are a date fields. So we add a date formatter. 
    billList.addColumn(Settings.i18n().tr("Start date"),"startdate",new DateFormatter(Settings.DATEFORMAT));
    billList.addColumn(Settings.i18n().tr("End date"),"enddate",    new DateFormatter(Settings.DATEFORMAT));

    // 7) calculated bill price (price per hour * hours)
    billList.addColumn(Settings.i18n().tr("Efforts"),"summary", new CurrencyFormatter(Settings.CURRENCY,Settings.DECIMALFORMAT));

		// 8) we are adding a context menu
		billList.setContextMenu(new BillListMenu());
    return billList;
  }

	/**
	 * Returns a list of positions in this bill.
   * @return list of positions in this bill
   * @throws RemoteException
   */
  public Part getPositionList() throws RemoteException
	{
		if (positionList != null)
			return positionList;

		DBIterator positions = getBill().getPositions();
		positionList = new TablePart(positions,new PositionDetail());
		positionList.addColumn(Settings.i18n().tr("Position name"),"name");
		positionList.addColumn(Settings.i18n().tr("Description"),"description");
		positionList.addColumn(Settings.i18n().tr("Effort"),"effort",new Formatter()
    {
      public String format(Object o)
      {
      	if (o == null)
      		return "-";
        return o + " h";
      }
    });
    
		PositionListMenu tlm = new PositionListMenu();

		// we add an additional menu item to create positions with predefined bill.
		tlm.addItem(new ContextMenuItem(Settings.i18n().tr("Create new position within this Bill"),new Action()
    {
      public void handleAction(Object context) throws ApplicationException
      {
      	new PositionDetail().handleAction(getBill());
      }
    }));
    positionList.setContextMenu(tlm);
    positionList.setSummary(false);
    return positionList;
	}

  /**
   * This method stores the bill using the current values. 
   */
  public void handleStore()
  {
    try
    {

      // get the current bill.
      Bill p = getBill();

      // invoke all Setters of this bill and assign the current values
      p.setName((String) getName().getValue());
      p.setDescription((String) getDescription().getValue());

      // we can cast the return value of date input directly to "java.util.Date".
      p.setBillDate((Date) getBillDate().getValue());

	  // the DecimalInput fields returns a Double object
      Double d = (Double) getPrice().getValue();
      p.setPrice(d == null ? 0.0 : d.doubleValue());

      // Now, let's store the bill
      // The store() method throws ApplicationExceptions if
      // insertCheck() or updateCheck() failed.

      // we can cast the value of the customer dialogInput directly to "Customer".
      p.setCustomer((Customer) getCustomer().getValue());      
      try
      {
        p.store();
        Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Bill stored successfully"),StatusBarMessage.TYPE_SUCCESS));
      }
      catch (ApplicationException e)
      {
        Application.getMessagingFactory().sendMessage(new StatusBarMessage(e.getMessage(),StatusBarMessage.TYPE_ERROR));
      }
    }
    catch (RemoteException e)
    {
      Logger.error("error while storing bill",e);
      Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Error while storing Bill: {0}",e.getMessage()),StatusBarMessage.TYPE_ERROR));
    }
  }

}
