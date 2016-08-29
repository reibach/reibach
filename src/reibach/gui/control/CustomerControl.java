package reibach.gui.control;

import java.rmi.RemoteException;
import org.eclipse.swt.widgets.Event;
import org.eclipse.swt.widgets.Listener;

import reibach.gui.menu.CustomerListMenu;
import reibach.Settings;
import reibach.rmi.Bill;
import reibach.rmi.Customer;
import reibach.rmi.Project;

import de.willuhn.datasource.rmi.DBIterator;
import de.willuhn.datasource.rmi.DBService;
import de.willuhn.jameica.gui.AbstractControl;
import de.willuhn.jameica.gui.AbstractView;
import de.willuhn.jameica.gui.Part;
import de.willuhn.jameica.gui.formatter.CurrencyFormatter;
import de.willuhn.jameica.gui.formatter.DateFormatter;
import de.willuhn.jameica.gui.input.DecimalInput;
import de.willuhn.jameica.gui.input.Input;
import de.willuhn.jameica.gui.input.SelectInput;
import de.willuhn.jameica.gui.input.TextAreaInput;
import de.willuhn.jameica.gui.input.TextInput;
import de.willuhn.jameica.gui.parts.TablePart;
import de.willuhn.jameica.messaging.StatusBarMessage;
import de.willuhn.jameica.system.Application;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;


import java.io.File;
import java.io.FileOutputStream;
import java.io.OutputStream;
import java.rmi.RemoteException;
import java.util.Date;

import org.eclipse.swt.widgets.Event;
import org.eclipse.swt.widgets.Listener;


/**
 * Controller for the customer view.
 */
public class CustomerControl extends AbstractControl
{	
	// list of all bills
	private TablePart customerList;
	
	  // the current customer object
	private Customer customer;

	// the input fields for the customer.
	private TextInput company;	
	private TextInput title;
	private TextInput firstname;
	private TextInput lastname;
	private TextInput street;
	private TextInput housenumber;
	private TextInput zipcode;
	private TextInput place;
	private TextInput email;
	private TextInput tel;
	private TextInput fax;
	private TextInput mobil;
	private TextAreaInput comment;

  /**
   * ct.
   * @param view
   */
  public CustomerControl(AbstractView view)
  {
    super(view);
  }

	/**
	 * Returns the current customer.
   * @return the customer.
   */
  private Customer getCustomer()
	{
		if (customer != null)
			return customer;
		customer = (Customer) getCurrentObject();
		return customer;
	}

	
	/**
	 * Returns an input field for the customer Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getCompany() throws RemoteException
	{
		if (company != null)
			return company;
		// "255" is the maximum length of the name attribute.
		try { 
				company = new TextInput(getCustomer().getCompany(),255);
				company.setMandatory(true);
				company.setName(Settings.i18n().tr("Company"));
		} catch(Exception exc) { 
				exc.printStackTrace();
		}
		return company;
	}

/**
 * Returns an input field for the customer Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getTitle() throws RemoteException
{
	if (title!= null)
		return title;
	// "255" is the maximum length of the name attribute.
	title = new TextInput(getCustomer().getTitle(),255);
	title.setMandatory(true);
	title.setName(Settings.i18n().tr("Title"));
	return title;
}

/**
 * Returns an input field for the customer Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getFirstname() throws RemoteException
{
	if (firstname != null)
		return firstname;
	// "255" is the maximum length of the name attribute.
	firstname = new TextInput(getCustomer().getFirstname(),255);
	firstname.setMandatory(true);
	firstname.setName(Settings.i18n().tr("Firstname"));
	return firstname;
}




/**
 * Returns an input field for the customer Lastname.
* @return input field.
* @throws RemoteException
*/
public Input getLastname() throws RemoteException
{
	if (lastname != null)
		return lastname;
	// "255" is the maximum length of the name attribute.
	lastname = new TextInput(getCustomer().getLastname(),255);
	lastname.setMandatory(true);
	lastname.setName(Settings.i18n().tr("Lastname"));
	return lastname;
}




/**
 * Returns an input field for the customer Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getStreet() throws RemoteException
{
	if (street != null)
		return street;
	// "255" is the maximum length of the name attribute.
	street = new TextInput(getCustomer().getStreet(),255);
	street.setMandatory(true);
	street.setName(Settings.i18n().tr("Street"));
	return street;
}


/**
 * Returns an input field for the customer Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getHousenumber() throws RemoteException
{
	if (housenumber != null)
		return housenumber;
	// "255" is the maximum length of the name attribute.
	housenumber = new TextInput(getCustomer().getHousenumber(),255);
	housenumber.setMandatory(true);
	housenumber.setName(Settings.i18n().tr("Housenumber"));
	return housenumber;
}


/**
 * Returns an input field for the customer Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getZipcode() throws RemoteException
{
	if (zipcode != null)
		return zipcode;
	// "255" is the maximum length of the name attribute.
	zipcode = new TextInput(getCustomer().getZipcode(),255);
	zipcode.setMandatory(true);
	zipcode.setName(Settings.i18n().tr("Zipcode"));
	return zipcode;
}


/**
 * Returns an input field for the customer Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getPlace() throws RemoteException
{
	if (place != null)
		return place;
	// "255" is the maximum length of the name attribute.
	place = new TextInput(getCustomer().getPlace(),255);
	place.setMandatory(true);
	place.setName(Settings.i18n().tr("Place"));
	return place;
}


/**
 * Returns an input field for the customer Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getEmail() throws RemoteException
{
	if (email != null)
		return email;
	// "255" is the maximum length of the name attribute.
	email = new TextInput(getCustomer().getEmail(),255);
	email.setMandatory(true);
	email.setName(Settings.i18n().tr("Email"));
	return email;
}


/**
 * Returns an input field for the customer Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getTel() throws RemoteException
{
	if (tel != null)
		return tel;
	// "255" is the maximum length of the name attribute.
	tel = new TextInput(getCustomer().getTel(),255);
	tel.setMandatory(true);
	tel.setName(Settings.i18n().tr("Tel"));
	return tel;
}

/**
 * Returns an input field for the customer Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getFax() throws RemoteException
{
	if (fax != null)
		return fax;
	// "255" is the maximum length of the name attribute.
	fax = new TextInput(getCustomer().getFax(),255);
	fax.setMandatory(true);
	fax.setName(Settings.i18n().tr("Fax"));
	return fax;
}



/**
 * Returns an input field for the customer Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getMobil() throws RemoteException
{
	if (mobil != null)
		return mobil;
	// "255" is the maximum length of the name attribute.
	mobil = new TextInput(getCustomer().getMobil(),255);
	mobil.setMandatory(true);
	mobil.setName(Settings.i18n().tr("Mobil"));
	return mobil;
}




	/**
	 * Returns an input field for the customer comment.
   * @return input field.
   * @throws RemoteException
   */
  public Input getComment() throws RemoteException
	{
		if (comment != null)
			return comment;
		comment = new TextAreaInput(getCustomer().getComment());
		comment.setName("");		
		return comment;
	}

  
	/**
	 * This method stores the customer using the current values. 
	 */
	public void handleStore()
	{
		try
		{

			// get the current customer.
			Customer t = getCustomer();

			// invoke all Setters of this customer and assign the current values
			t.setCompany((String) getCompany().getValue());
			t.setTitle((String) getTitle().getValue());
			t.setFirstname((String) getFirstname().getValue());
			t.setLastname((String) getLastname().getValue());
			t.setStreet((String) getStreet().getValue());
			t.setHousenumber((String) getHousenumber().getValue());
			t.setZipcode((String) getZipcode().getValue());
			t.setPlace((String) getPlace().getValue());
			t.setEmail((String) getEmail().getValue());
			t.setTel((String) getTel().getValue());
			t.setFax((String) getFax().getValue());
			t.setMobil((String) getMobil().getValue());			
			t.setComment((String) getComment().getValue());

			// Now, let's store the project
			// The store() method throws ApplicationExceptions if
			// insertCheck() or updateCheck() failed.
			try
			{
				t.store();
		        Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Customer stored successfully"),StatusBarMessage.TYPE_SUCCESS));
			}
			catch (ApplicationException e)
			{
      Application.getMessagingFactory().sendMessage(new StatusBarMessage(e.getMessage(),StatusBarMessage.TYPE_ERROR));
			}
		}
		catch (RemoteException e)
		{
			Logger.error("error while storing customer",e);
    Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Error while storing Customer: {0}",e.getMessage()),StatusBarMessage.TYPE_ERROR));
		}
	}

	/**
	 * This method stores the customer using the current values. 
	 */
	public void handleStoreDefault()
	{
		try
		{

			// get the current customer.
			Customer t = getCustomer();

			// invoke all Setters of this customer and assign the current values
			t.setCompany("TestFirma GmbH");
			t.setTitle("Herr");
			t.setFirstname("Max");
			t.setLastname("Mustermann");
			t.setStreet("Waldstr. ");
			t.setHousenumber("22");
			t.setZipcode("12345");
			t.setPlace("Waldstadt");
			t.setEmail("test@testfirma.de");
			t.setTel("01234 456723");
			t.setFax("01234 456725");
			t.setMobil("0150 456723");			
			t.setComment("Nothing ....");

			// Now, let's store the project
			// The store() method throws ApplicationExceptions if
			// insertCheck() or updateCheck() failed.
			try
			{
				t.store();
        Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Customer stored successfully"),StatusBarMessage.TYPE_SUCCESS));
			}
			catch (ApplicationException e)
			{
        Application.getMessagingFactory().sendMessage(new StatusBarMessage(e.getMessage(),StatusBarMessage.TYPE_ERROR));
			}
		}
		catch (RemoteException e)
		{
			Logger.error("error while storing customer",e);
      Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Error while storing Customer: {0}",e.getMessage()),StatusBarMessage.TYPE_ERROR));
		}
	}

	/**
	   * Creates a table containing all bills.
	   * @return a table with bills.
	   * @throws RemoteException
	   */
	  public Part getCustomersTable() throws RemoteException
	  {
	    // do we have an allready created table?
	    if (customerList != null)
	      return customerList;
	   
	    // 1) get the dataservice
	       DBService service = Settings.getDBService();
	    
	    // 2) now we can create the bill list.
	    //    We do not need to specify the implementing class for
	    //    the interface "Bill". Jameicas Classloader knows
	    //    all classes an finds the right implementation automatically. ;)
	       DBIterator customers = service.createList(Customer.class);
	    
	    // 4) create the table
	     customerList = new TablePart(customers,new reibach.gui.action.CustomerDetail());

	    // 5) now we have to add some columns.
	     customerList.addColumn(Settings.i18n().tr("Company"),"company"); // "preis" is the field name from the sql table.
	     customerList.addColumn(Settings.i18n().tr("Title"),"title"); // "preis" is the field name from the sql table.
	     customerList.addColumn(Settings.i18n().tr("Firstname"),"firstname"); // "name" is the field name from the sql table.	
	     customerList.addColumn(Settings.i18n().tr("Lastname"),"lastname"); // "name" is the field name from the sql table.	
	     customerList.addColumn(Settings.i18n().tr("Street"),"street"); // "name" is the field name from the sql table.	
	     customerList.addColumn(Settings.i18n().tr("Housenumber"),"housenumber"); // "name" is the field name from the sql table.	
	     customerList.addColumn(Settings.i18n().tr("Zipcode"),"zipcode"); // "name" is the field name from the sql table.	
	     customerList.addColumn(Settings.i18n().tr("Place"),"place"); // "name" is the field name from the sql table.	
	     customerList.addColumn(Settings.i18n().tr("Email"),"email"); // "name" is the field name from the sql table.	
	     customerList.addColumn(Settings.i18n().tr("Tel"),"tel"); // "name" is the field name from the sql table.	
	     customerList.addColumn(Settings.i18n().tr("Fax"),"fax"); // "name" is the field name from the sql table.	
	     customerList.addColumn(Settings.i18n().tr("Mobil"),"mobil"); // "name" is the field name from the sql table.	

	     /** 	    

		*/
			// 8) we are adding a context menu
	    customerList.setContextMenu(new CustomerListMenu());
	    return customerList;
	  }
}