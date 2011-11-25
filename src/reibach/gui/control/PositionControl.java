/**********************************************************************
 * $Source: /cvsroot/jameica/jameica_exampleplugin/src/de/willuhn/jameica/example/gui/control/PositionControl.java,v $
 * $Revision: 1.3 $
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

import java.rmi.RemoteException;

import reibach.Settings;
import reibach.rmi.Bill;
import reibach.rmi.Position;

import de.willuhn.jameica.gui.AbstractControl;
import de.willuhn.jameica.gui.AbstractView;
import de.willuhn.jameica.gui.input.DecimalInput;
import de.willuhn.jameica.gui.input.Input;
import de.willuhn.jameica.gui.input.SelectInput;
import de.willuhn.jameica.gui.input.TextAreaInput;
import de.willuhn.jameica.gui.input.TextInput;
import de.willuhn.jameica.messaging.StatusBarMessage;
import de.willuhn.jameica.system.Application;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;

/**
 * Controller for the position view.
 */
public class PositionControl extends AbstractControl
{

	// the current position object
	private Position position;

	// the input fields for the position.
	private SelectInput bill;
	private TextInput name;
	private DecimalInput price;
	private TextAreaInput comment;

  /**
   * ct.
   * @param view
   */
  public PositionControl(AbstractView view)
  {
    super(view);
  }

	/**
	 * Returns the current position.
   * @return the position.
   */
  private Position getPosition()
	{
		if (position != null)
			return position;
		position = (Position) getCurrentObject();
		return position;
	}

	/**
	 * Returns a the field to choose the bill.
   * @return the bill.
   * @throws RemoteException
   */
  public Input getBill() throws RemoteException
	{
		if (bill != null)
			return bill;
		
		bill = new SelectInput(Settings.getDBService().createList(Bill.class),getPosition().getBill());
    bill.setName(Settings.i18n().tr("Bill"));
    bill.setMandatory(true);
    return bill;
	}

	/**
	 * Returns an input field for the position name.
   * @return input field.
   * @throws RemoteException
   */
  public Input getName() throws RemoteException
	{
		if (name != null)
			return name;
		// "255" is the maximum length of the name attribute.
		name = new TextInput(getPosition().getName(),255);
		name.setMandatory(true);
		name.setName(Settings.i18n().tr("Name"));
		return name;
	}

	/**
	 * Returns an input field for the task effort.
	* @return input field.
	* @throws RemoteException
	*/
	public Input getPrice() throws RemoteException
	{
		if (price != null)
			return price;

		// we assign our system decimal formatter
		price = new DecimalInput(getPosition().getPrice(),Settings.DECIMALFORMAT);
		price.setName(Settings.i18n().tr("Price"));
		// price.setComment(Settings.i18n().tr("Hours [example: enter \"0,5\" to store 30 minutes]"));
		return price;
	}

	/**
	 * Returns an input field for the position comment.
   * @return input field.
   * @throws RemoteException
   */
  public Input getComment() throws RemoteException
	{
		if (comment != null)
			return comment;
		comment = new TextAreaInput(getPosition().getComment());
		comment.setName("");
		return comment;
	}

	/**
	 * This method stores the position using the current values. 
	 */
	public void handleStore()
	{
		try
		{

			// get the current position.
			Position t = getPosition();

			// invoke all Setters of this position and assign the current values
			t.setName((String) getName().getValue());

			// we can cast the value of the bill dialogInput directly to "Bill".
			t.setBill((Bill) getBill().getValue());

			// the DecimalInput fields returns a Double object
			Double d = (Double) getPrice().getValue(); 
			t.setPrice(d == null ? 0.0 : d.doubleValue());

			t.setComment((String) getComment().getValue());

			// Now, let's store the bill
			// The store() method throws ApplicationExceptions if
			// insertCheck() or updateCheck() failed.
			try
			{
				t.store();
        Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Position stored successfully"),StatusBarMessage.TYPE_SUCCESS));
			}
			catch (ApplicationException e)
			{
        Application.getMessagingFactory().sendMessage(new StatusBarMessage(e.getMessage(),StatusBarMessage.TYPE_ERROR));
			}
		}
		catch (RemoteException e)
		{
			Logger.error("error while storing position",e);
      Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Error while storing Position: {0}",e.getMessage()),StatusBarMessage.TYPE_ERROR));
		}
	}

}


/**********************************************************************
 * $Log: PositionControl.java,v $
 * Revision 1.3  2010-11-09 17:20:16  willuhn
 * @N Beispiel-Plugin auf aktuellen Stand gebracht. Code-Cleanup und Beispiel-Implementierung fuer Search-API hinzugefuegt
 *
 **********************************************************************/