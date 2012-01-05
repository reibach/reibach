package reibach.server;


import java.rmi.RemoteException;

import reibach.Settings;
import reibach.rmi.Mandator;

import de.willuhn.datasource.db.AbstractDBObject;
import de.willuhn.datasource.rmi.DBIterator;
import de.willuhn.datasource.rmi.DBService;
import de.willuhn.datasource.rmi.ObjectNotFoundException;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;

/**
 * Implementation of the mandator interface.
 * Look into ProjectImpl for more code comments.
 */
public class MandatorImpl extends AbstractDBObject implements Mandator
{

  /**
   * ct.
   * @throws RemoteException
   */
  public MandatorImpl() throws RemoteException
  {
    super();
  }

  /**
   * @see de.willuhn.datasource.db.AbstractDBObject#getTableName()
   */
  protected String getTableName()
  {
  	// this is the sql table name.
    return "mandator";
  }

  /**
   * @see de.willuhn.datasource.GenericObject#getPrimaryAttribute()
   */
  public String getPrimaryAttribute() throws RemoteException
  {
  	// our primary attribute is the name.
//	  return "name";
	  return "company";
}

  /**
   * @see de.willuhn.datasource.db.AbstractDBObject#deleteCheck()
   */
  protected void deleteCheck() throws ApplicationException
  {
  }

  /**
   * @see de.willuhn.datasource.db.AbstractDBObject#insertCheck()
   */
  protected void insertCheck() throws ApplicationException
  {
		try {
			if (getLastname() == null || getLastname().length() == 0)
				throw new ApplicationException(Settings.i18n().tr("Please enter a mandator lastname"));
		}
		catch (RemoteException e)
		{
			Logger.error("insert check of project failed",e);
			throw new ApplicationException(Settings.i18n().tr("unable to store project, please check the system log"));
		}
  }

  /**
   * @see de.willuhn.datasource.db.AbstractDBObject#updateCheck()
   */
  protected void updateCheck() throws ApplicationException
  {
  	// same as insertCheck
  	insertCheck();
  }

  /**
   * @see reibach.rmi.Mandator#getName()
   */
  public String getCompany() throws RemoteException
  {
    return (String) getAttribute("company");
  }

  /**
   * @see reibach.rmi.Mandator#setName(java.lang.String)
   */
  public void setCompany(String company) throws RemoteException
  {
  	setAttribute("company",company);
  }

 
  /**
   * @see reibach.rmi.Mandator#getSlogan()
   */
  public String getSlogan() throws RemoteException
  {
    return (String) getAttribute("slogan");
  }

  /**
   * @see reibach.rmi.Mandator#setName(java.lang.String)
   */
  public void setSlogan(String slogan) throws RemoteException
  {
  	setAttribute("slogan",slogan);
  }

  
  /**
   * @see reibach.rmi.Mandator#setName(java.lang.String)
   */
  public void setTitle(String title) throws RemoteException
  {
  	setAttribute("title",title);
  }

  
   /**
   * @see reibach.rmi.Mandator#getName()
   */
  public String getTitle() throws RemoteException
  {
    return (String) getAttribute("title");
  }

  /**
   * @see reibach.rmi.Mandator#getName()
   */
  public String getFirstname() throws RemoteException
  {
    return (String) getAttribute("firstname");
  }

  /**
   * @see reibach.rmi.Mandator#setName(java.lang.String)
   */
  public void setFirstname(String firstname) throws RemoteException
  {
  	setAttribute("firstname",firstname);
  }


  /**
   * @see reibach.rmi.Mandator#getName()
   */
  public String getLastname() throws RemoteException
  {
    return (String) getAttribute("lastname");
  }

  /**
   * @see reibach.rmi.Mandator#setName(java.lang.String)
   */
  public void setLastname(String lastname) throws RemoteException
  {
  	setAttribute("lastname",lastname);
  }

  /**
   * @see reibach.rmi.Mandator#getName()
   */
  public String getStreet() throws RemoteException
  {
    return (String) getAttribute("street");
  }

  /**
   * @see reibach.rmi.Mandator#setName(java.lang.String)
   */
  public void setStreet(String street) throws RemoteException
  {
  	setAttribute("street",street);
  }

  /**
   * @see reibach.rmi.Mandator#getName()
   */
  public String getHousenumber() throws RemoteException
  {
    return (String) getAttribute("housenumber");
  }

  /**
   * @see reibach.rmi.Mandator#setName(java.lang.String)
   */
  public void setHousenumber(String housenumber) throws RemoteException
  {
  	setAttribute("housenumber",housenumber);
  }

  /**
   * @see reibach.rmi.Mandator#getName()
   */
  public String getZipcode() throws RemoteException
  {
    return (String) getAttribute("zipcode");
  }

  /**
   * @see reibach.rmi.Mandator#setName(java.lang.String)
   */
  public void setZipcode(String zipcode) throws RemoteException
  {
  	setAttribute("zipcode",zipcode);
  }

  /**
   * @see reibach.rmi.Mandator#getName()
   */
  public String getPlace() throws RemoteException
  {
    return (String) getAttribute("place");
  }

  /**
   * @see reibach.rmi.Mandator#setName(java.lang.String)
   */
  public void setPlace(String place) throws RemoteException
  {
  	setAttribute("place",place);
  }

  /**
   * @see reibach.rmi.Mandator#getName()
   */
  public String getEmail() throws RemoteException
  {
    return (String) getAttribute("email");
  }

  /**
   * @see reibach.rmi.Mandator#setName(java.lang.String)
   */
  public void setEmail(String email) throws RemoteException
  {
  	setAttribute("email",email);
  }

  /**
   * @see reibach.rmi.Mandator#getName()
   */
  public String getWebsite() throws RemoteException
  {
    return (String) getAttribute("website");
  }

  /**
   * @see reibach.rmi.Mandator#setName(java.lang.String)
   */
  public void setWebsite(String website) throws RemoteException
  {
  	setAttribute("website",website);
  }

  /**
   * @see reibach.rmi.Mandator#getName()
   */
  public String getTel() throws RemoteException
  {
    return (String) getAttribute("tel");
  }

  /**
   * @see reibach.rmi.Mandator#setName(java.lang.String)
   */
  public void setTel(String tel) throws RemoteException
  {
  	setAttribute("tel",tel);
  }

  /**
   * @see reibach.rmi.Mandator#getName()
   */
  public String getFax() throws RemoteException
  {
    return (String) getAttribute("fax");
  }

  /**
   * @see reibach.rmi.Mandator#setName(java.lang.String)
   */
  public void setFax(String fax) throws RemoteException
  {
  	setAttribute("fax",fax);
  }

  /**
   * @see reibach.rmi.Mandator#getName()
   */
  public String getMobil() throws RemoteException
  {
    return (String) getAttribute("mobil");
  }

  /**
   * @see reibach.rmi.Mandator#setName(java.lang.String)
   */
  public void setMobil(String mobil) throws RemoteException
  {
  	setAttribute("mobil",mobil);
  }

  
  /**
   * @see reibach.rmi.Mandator#getComment()
   */
  public String getComment() throws RemoteException
  {
    return (String) getAttribute("comment");
  }
 
  /**
   * @see reibach.rmi.Mandator#setComment(java.lang.String)
   */
  public void setComment(String comment) throws RemoteException
  {
  	setAttribute("comment",comment);
  }


  public void setBankname(String bankname) throws RemoteException
  {
  	setAttribute("bankname",bankname);
  }
  public String getBankname() throws RemoteException
  {
    return (String) getAttribute("bankname");
  }

  public void setBankaccount(String bankaccount) throws RemoteException
  {
  	setAttribute("bankaccount",bankaccount);
  }
  public String getBankaccount() throws RemoteException
  {
    return (String) getAttribute("bankaccount");
  }

  public void setBankcodenumber(String bankcodenumber) throws RemoteException
  {
  	setAttribute("bankcodenumber",bankcodenumber);
  }
 
  public String getBankcodenumber() throws RemoteException
  {
    return (String) getAttribute("bankcodenumber");
  }
  
  
  public String getIban() throws RemoteException
  {
    return (String) getAttribute("iban");
  }

  public void setIban(String iban) throws RemoteException
  {
  	setAttribute("iban",iban);
  }
 
  public String getBic() throws RemoteException
  {
    return (String) getAttribute("bic");
  }

  public void setBic(String bic) throws RemoteException
  {
  	setAttribute("bic",bic);
  }

  
  
  public void setTaxoffice(String taxoffice) throws RemoteException
  {
  	setAttribute("taxoffice",taxoffice);
  }

  public String getTaxoffice() throws RemoteException
  {
    return (String) getAttribute("taxoffice");
  }

  public void setVatnumber(String vatnumber) throws RemoteException
  {
  	setAttribute("vatnumber",vatnumber);
  }

  public String getVatnumber() throws RemoteException
  {
    return (String) getAttribute("vatnumber");
  }

  public void setTaxnumber(String taxnumber) throws RemoteException
  {
  	setAttribute("taxnumber",taxnumber);
  }

  public String getTaxnumber() throws RemoteException
  {
    return (String) getAttribute("taxnumber");
  }
  

  
  /**
   * @see reibach.rmi.Mandator#getMandators()
   */
	public DBIterator getMandators() throws RemoteException
	{
		try
  {
    // 1) Get the Database Service.
    DBService service = this.getService();

    // you can get the Database Service also via:
    // DBService service = this.getService();
    
    // 3) We create the task list using getList(Class)
    DBIterator mandators = service.createList(Mandator.class);
        
    return mandators;
  }
  catch (Exception e)
  {
  	throw new RemoteException("unable to load mandators list",e);
  }
	}
	
	 /**
	   * @see reibach.rmi.Task#setEffort(double)
	   */
	  public void setEffort(double effort) throws RemoteException
	  {
	  	setAttribute("effort", new Double(effort));
	  }

		/**
		 * @see reibach.rmi.Bill#setPrice(double)
		 */
		public void setPrice(double price) throws RemoteException
		{
	    // setField() wants to have an object but <prive> is a primitive type.
	    // So we have to make a java.lang.Double
	    setAttribute("price",new Double(price));
	  }


}