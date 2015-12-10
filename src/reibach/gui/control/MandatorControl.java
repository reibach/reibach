package reibach.gui.control;

import java.rmi.RemoteException;

import org.eclipse.swt.widgets.Event;
import org.eclipse.swt.widgets.Listener;

import reibach.Settings;
import reibach.rmi.Mandator;
import reibach.gui.menu.MandatorListMenu;

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

/**
 * Controller for the mandator view.
 */
public class MandatorControl extends AbstractControl
{

	
	// list of all bills
	private TablePart mandatorList;
	
	  // the current mandator object
	private Mandator mandator;

	// the input fields for the mandator.
	private TextInput company;	
	private TextInput slogan;	
	private TextInput title;
	private TextInput firstname;
	private TextInput lastname;
	private TextInput street;
	private TextInput housenumber;
	private TextInput zipcode;
	private TextInput place;
	private TextInput email;
	private TextInput website;	
	private TextInput tel;
	private TextInput fax;
	private TextInput mobil;
	private TextAreaInput comment;
	private TextInput bankname;
	private TextInput bankaccount;
	private TextInput bankcodenumber;
	private TextInput iban;
	private TextInput bic;
	private TextInput taxoffice;
	private TextInput vatnumber;
	private TextInput vat;
	private TextInput taxnumber;
	

  /**
   * ct.
   * @param view
   */
  public MandatorControl(AbstractView view)
  {
    super(view);
  }

	/**
	 * Returns the current mandator.
   * @return the mandator.
   */
  private Mandator getMandator()
	{
		if (mandator != null)
			return mandator;
		mandator = (Mandator) getCurrentObject();
		return mandator;
	}

	
	/**
	 * Returns an input field for the mandator Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getCompany() throws RemoteException
	{
		if (company != null)
			return company;
		// "255" is the maximum length of the name attribute.
		company = new TextInput(getMandator().getCompany(),255);
		company.setMandatory(true);
		company.setName(Settings.i18n().tr("company"));
		return company;
	}


/**
 * Returns an input field for the mandator Slogan.
* @return input field.
* @throws RemoteException
*/
public Input getSlogan() throws RemoteException
{
	if (slogan != null)
		return slogan;
	// "255" is the maximum length of the name attribute.
	slogan = new TextInput(getMandator().getSlogan(),255);
	slogan.setName(Settings.i18n().tr("slogan"));
	return slogan;
}

/**
 * Returns an input field for the mandator Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getTitle() throws RemoteException
{
	if (title!= null)
		return title;
	// "255" is the maximum length of the name attribute.
	title = new TextInput(getMandator().getTitle(),255);
	title.setMandatory(true);
	title.setName(Settings.i18n().tr("title"));
	return title;
}

/**
 * Returns an input field for the mandator Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getFirstname() throws RemoteException
{
	if (firstname != null)
		return firstname;
	// "255" is the maximum length of the name attribute.
	firstname = new TextInput(getMandator().getFirstname(),255);
	firstname.setMandatory(true);
	firstname.setName(Settings.i18n().tr("firstname"));
	return firstname;
}




/**
 * Returns an input field for the mandator Lastname.
* @return input field.
* @throws RemoteException
*/
public Input getLastname() throws RemoteException
{
	if (lastname != null)
		return lastname;
	// "255" is the maximum length of the name attribute.
	lastname = new TextInput(getMandator().getLastname(),255);
	lastname.setMandatory(true);
	lastname.setName(Settings.i18n().tr("Lastname"));
	return lastname;
}




/**
 * Returns an input field for the mandator Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getStreet() throws RemoteException
{
	if (street != null)
		return street;
	// "255" is the maximum length of the name attribute.
	street = new TextInput(getMandator().getStreet(),255);
	street.setMandatory(true);
	street.setName(Settings.i18n().tr("street"));
	return street;
}


/**
 * Returns an input field for the mandator Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getHousenumber() throws RemoteException
{
	if (housenumber != null)
		return housenumber;
	// "255" is the maximum length of the name attribute.
	housenumber = new TextInput(getMandator().getHousenumber(),255);
	housenumber.setMandatory(true);
	housenumber.setName(Settings.i18n().tr("housenumber"));
	return housenumber;
}


/**
 * Returns an input field for the mandator Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getZipcode() throws RemoteException
{
	if (zipcode != null)
		return zipcode;
	// "255" is the maximum length of the name attribute.
	zipcode = new TextInput(getMandator().getZipcode(),255);
	zipcode.setMandatory(true);
	zipcode.setName(Settings.i18n().tr("zipcode"));
	return zipcode;
}


/**
 * Returns an input field for the mandator Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getPlace() throws RemoteException
{
	if (place != null)
		return place;
	// "255" is the maximum length of the name attribute.
	place = new TextInput(getMandator().getPlace(),255);
	place.setMandatory(true);
	place.setName(Settings.i18n().tr("place"));
	return place;
}


/**
 * Returns an input field for the mandator Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getEmail() throws RemoteException
{
	if (email != null)
		return email;
	// "255" is the maximum length of the name attribute.
	email = new TextInput(getMandator().getEmail(),255);
	email.setMandatory(true);
	email.setName(Settings.i18n().tr("email"));
	return email;
}

/**
 * Returns an input field for the mandator website.
* @return input field.
* @throws RemoteException
*/
public Input getWebsite() throws RemoteException
{
	if (website != null)
		return website ;
	// "255" is the maximum length of the name attribute.
	website = new TextInput(getMandator().getWebsite(),255);
	website.setName(Settings.i18n().tr("website "));
	return website;
}


/**
 * Returns an input field for the mandator Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getTel() throws RemoteException
{
	if (tel != null)
		return tel;
	// "255" is the maximum length of the name attribute.
	tel = new TextInput(getMandator().getTel(),255);
	tel.setMandatory(true);
	tel.setName(Settings.i18n().tr("tel"));
	return tel;
}

/**
 * Returns an input field for the mandator Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getFax() throws RemoteException
{
	if (fax != null)
		return fax;
	// "255" is the maximum length of the name attribute.
	fax = new TextInput(getMandator().getFax(),255);
	fax.setMandatory(true);
	fax.setName(Settings.i18n().tr("fax"));
	return fax;
}



/**
 * Returns an input field for the mandator Firstname.
* @return input field.
* @throws RemoteException
*/
public Input getMobil() throws RemoteException
{
	if (mobil != null)
		return mobil;
	// "255" is the maximum length of the name attribute.
	mobil = new TextInput(getMandator().getMobil(),255);
	mobil.setMandatory(true);
	mobil.setName(Settings.i18n().tr("mobil"));
	return mobil;
}

/**
* @return input field.
* @throws RemoteException
*/
public Input getComment() throws RemoteException
{
	if (comment != null)
		return comment;
	comment = new TextAreaInput(getMandator().getComment());
	comment.setName("Comment - will not be printed");		
	return comment;
}



public Input getBankname() throws RemoteException
{
	if (bankname != null)
		return bankname;
	bankname = new TextInput(getMandator().getBankname());
	bankname.setName("bankname");		
	return bankname;
}

public Input getBankaccount() throws RemoteException
{
	if (bankaccount != null)
		return bankaccount;
	bankaccount = new TextInput(getMandator().getBankaccount());
	bankaccount.setName("Bankaccount");		
	return bankaccount;
}

public Input getBankcodenumber() throws RemoteException
{
	if (bankcodenumber != null)
		return bankcodenumber;
	bankcodenumber = new TextInput(getMandator().getBankcodenumber());
	bankcodenumber.setName("Bankcodenumber");		
	return bankcodenumber;
}

public Input getIban() throws RemoteException
{
	if (iban != null)
		return comment;
	iban = new TextInput(getMandator().getIban());
	iban.setName("Iban");		
	return iban;
}

public Input getBic() throws RemoteException
{
	if (bic != null)
		return bic;
	bic = new TextInput(getMandator().getBic());
	bic.setName("Bic");		
	return bic;
}

public Input getTaxoffice() throws RemoteException
{
	if (taxoffice != null)
		return taxoffice;
	taxoffice = new TextInput(getMandator().getTaxoffice());
	taxoffice.setName("Taxoffice");		
	return taxoffice;
}

public Input getVatnumber() throws RemoteException
{
	if (vatnumber != null)
		return vatnumber;
	vatnumber = new TextInput(getMandator().getVatnumber());
	vatnumber.setName("Vatnumber");		
	return vatnumber;
}

public Input getVat() throws RemoteException
{
	if (vat != null)
		return vat;
	
	vat = new TextInput(getMandator().getVat());
	vat.setName("vat");		
	return vat;
}

public Input getTaxnumber() throws RemoteException
{
	if (taxnumber != null)
		return taxnumber;
	taxnumber = new TextInput(getMandator().getTaxnumber());
	taxnumber.setName("Taxnumber");		
	return taxnumber;
}

  
  
/**
 * This method stores the mandator using the current values. 
 */
public void handleStore()
{
	try
	{

		// get the current mandator.
		Mandator t = getMandator();

		// invoke all Setters of this mandator and assign the current values
		t.setCompany((String) getCompany().getValue());
		t.setSlogan((String) getSlogan().getValue());
		t.setTitle((String) getTitle().getValue());
		t.setFirstname((String) getFirstname().getValue());
		t.setLastname((String) getLastname().getValue());
		t.setStreet((String) getStreet().getValue());
		t.setHousenumber((String) getHousenumber().getValue());
		t.setZipcode((String) getZipcode().getValue());
		t.setPlace((String) getPlace().getValue());
		t.setEmail((String) getEmail().getValue());
		t.setWebsite((String) getWebsite().getValue());
		t.setTel((String) getTel().getValue());
		t.setFax((String) getFax().getValue());
		t.setMobil((String) getMobil().getValue());			
		t.setComment((String) getComment().getValue());
		t.setBankname((String) getBankname().getValue());
		t.setBankaccount((String) getBankaccount().getValue());
		t.setBankcodenumber((String) getBankcodenumber().getValue());
		t.setIban((String) getIban().getValue());
		t.setBic((String) getBic().getValue());
		t.setTaxoffice((String) getTaxoffice().getValue());
		t.setVatnumber((String) getVatnumber().getValue());
		t.setTaxnumber((String) getTaxnumber().getValue());
		t.setVat((String) getVat().getValue());

		// Now, let's store the project
		// The store() method throws ApplicationExceptions if
		// insertCheck() or updateCheck() failed.
		try
		{
			t.store();
    Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Mandator stored successfully"),StatusBarMessage.TYPE_SUCCESS));
		}
		catch (ApplicationException e)
		{
    Application.getMessagingFactory().sendMessage(new StatusBarMessage(e.getMessage(),StatusBarMessage.TYPE_ERROR));
		}
	}
	catch (RemoteException e)
	{
		Logger.error("error while storing mandator",e);
  Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Error while storing Mandator: {0}",e.getMessage()),StatusBarMessage.TYPE_ERROR));
	}
}

/**
 * This method stores the mandator using the current values. 
 */
public void handleStoreDefault()
{
	try
	{

		// get the current mandator.
		Mandator t = getMandator();

		// invoke all Setters of this mandator and assign the current values
		t.setCompany("federa");
		t.setSlogan("Internet - Support - Sicherheit");
		t.setTitle("Herr");
		t.setFirstname("Guenter");
		t.setLastname("Mittler");
		t.setStreet("Buxhorner Weg ");
		t.setHousenumber("15");
		t.setZipcode("27729");
		t.setPlace("Holste / Steden");
		t.setEmail("E-Mail: guenter@federa.de");
		t.setWebsite("http://federa.de");
		t.setTel("Tel: +49(0)4748 442437");
		t.setFax("Fax: +49(0)4748 442438");
		t.setMobil("Mob: +49(0)175 2717291");			
		t.setComment("");
		t.setBankname("Bank: KSK OHZ");
		t.setBankaccount("IBAN: DE89291523001401080666");
		t.setBankcodenumber("BIC: BRLADE21OHZ");
//		t.setBankaccount("Konto-Nr.: 1401080666");
//		t.setBankcodenumber("BLZ: 291523000");
		t.setIban("DE66788");
		t.setBic("DE9899898989");
		t.setTaxoffice("Finanzamt ");
		t.setVatnumber("Osterholz-Scharmbeck");
		t.setTaxnumber("Steuer-Nr.: 36/130/11311");
		t.setVat("1");

		// Now, let's store the project
		// The store() method throws ApplicationExceptions if
		// insertCheck() or updateCheck() failed.
		try
		{
			t.store();
    Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Mandator stored successfully"),StatusBarMessage.TYPE_SUCCESS));
		}
		catch (ApplicationException e)
		{
    Application.getMessagingFactory().sendMessage(new StatusBarMessage(e.getMessage(),StatusBarMessage.TYPE_ERROR));
		}
	}
	catch (RemoteException e)
	{
		Logger.error("error while storing mandator",e);
  Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Error while storing Mandator: {0}",e.getMessage()),StatusBarMessage.TYPE_ERROR));
	}
}

	/**
	   * Creates a table containing all bills.
	   * @return a table with bills.
	   * @throws RemoteException
	   */
	  public Part getMandatorsTable() throws RemoteException
	  {
	    // do we have an allready created table?
	    if (mandatorList != null)
	      return mandatorList;
	   
	    // 1) get the dataservice
	       DBService service = Settings.getDBService();
	    
	    // 2) now we can create the bill list.
	    //    We do not need to specify the implementing class for
	    //    the interface "Bill". Jameicas Classloader knows
	    //    all classes an finds the right implementation automatically. ;)
	       DBIterator mandators = service.createList(Mandator.class);
	    
	    // 4) create the table
	     mandatorList = new TablePart(mandators,new reibach.gui.action.MandatorDetail());

	    // 5) now we have to add some columns.
	     mandatorList.addColumn(Settings.i18n().tr("Company"),"company"); // "preis" is the field name from the sql table.
	     mandatorList.addColumn(Settings.i18n().tr("Title"),"title"); // "preis" is the field name from the sql table.
	     mandatorList.addColumn(Settings.i18n().tr("Firstname"),"firstname"); // "name" is the field name from the sql table.	
	     mandatorList.addColumn(Settings.i18n().tr("Lastname"),"lastname"); // "name" is the field name from the sql table.	
	     mandatorList.addColumn(Settings.i18n().tr("Street"),"street"); // "name" is the field name from the sql table.	
	     mandatorList.addColumn(Settings.i18n().tr("Housenumber"),"housenumber"); // "name" is the field name from the sql table.	
	     mandatorList.addColumn(Settings.i18n().tr("Zipcode"),"zipcode"); // "name" is the field name from the sql table.	
	     mandatorList.addColumn(Settings.i18n().tr("Place"),"place"); // "name" is the field name from the sql table.	
	     mandatorList.addColumn(Settings.i18n().tr("Email"),"email"); // "name" is the field name from the sql table.	
	     mandatorList.addColumn(Settings.i18n().tr("Tel"),"tel"); // "name" is the field name from the sql table.	
	     mandatorList.addColumn(Settings.i18n().tr("Fax"),"fax"); // "name" is the field name from the sql table.	
	     mandatorList.addColumn(Settings.i18n().tr("Mobil"),"mobil"); // "name" is the field name from the sql table.	
	     mandatorList.addColumn(Settings.i18n().tr("vat"),"vat"); // "name" is the field name from the sql table.	

	     /** 	    

		*/
			// 8) we are adding a context menu
	    mandatorList.setContextMenu(new MandatorListMenu());
	    return mandatorList;
	  }

	
}