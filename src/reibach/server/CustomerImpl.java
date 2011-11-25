/**********************************************************************
 * $Source: /cvsroot/jameica/jameica_exampleplugin/src/de/willuhn/jameica/example/server/CustomerImpl.java,v $
 * $Revision: 1.4 $
 * $Date: 2010-11-09 17:20:16 $
 * $Author: willuhn $
 * $Locker:  $
 * $State: Exp $
 *
 * Copyright (c) by willuhn.webdesign
 * All rights reserved
 *
 **********************************************************************/
package reibach.server;

/*
 * 
 * CREATE TABLE customer (
  id NUMERIC default UNIQUEKEY('customer'),
  company varchar(27) NOT NULL,
  title varchar(27) NOT NULL,
  firstname varchar(27) NOT NULL,
  lastname varchar(27) NOT NULL,
  street varchar(27) NOT NULL,
  housenumber varchar(27) NOT NULL,
  zipcode varchar(5) NOT NULL,
  place varchar(27) NOT NULL,
  email varchar(100) NOT NULL,
  tel varchar(27) NOT NULL,
  fax varchar(27) NOT NULL,
  mob varchar(27) NOT NULL,
  UNIQUE (id),
  PRIMARY KEY (id)
);

 */

import java.rmi.RemoteException;

import reibach.Settings;
import reibach.rmi.Customer;

import de.willuhn.datasource.db.AbstractDBObject;
import de.willuhn.datasource.rmi.DBIterator;
import de.willuhn.datasource.rmi.DBService;
import de.willuhn.datasource.rmi.ObjectNotFoundException;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;

/**
 * Implementation of the customer interface.
 * Look into ProjectImpl for more code comments.
 */
public class CustomerImpl extends AbstractDBObject implements Customer
{

  /**
   * ct.
   * @throws RemoteException
   */
  public CustomerImpl() throws RemoteException
  {
    super();
  }

  /**
   * @see de.willuhn.datasource.db.AbstractDBObject#getTableName()
   */
  protected String getTableName()
  {
  	// this is the sql table name.
    return "customer";
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
				throw new ApplicationException(Settings.i18n().tr("Please enter a customer lastname"));
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
   * @see reibach.rmi.Customer#getName()
   */
  public String getCompany() throws RemoteException
  {
    return (String) getAttribute("company");
  }

  /**
   * @see reibach.rmi.Customer#setName(java.lang.String)
   */
  public void setTitle(String title) throws RemoteException
  {
  	setAttribute("title",title);
  }
  /**
   * @see reibach.rmi.Customer#getName()
   */
  public String getTitle() throws RemoteException
  {
    return (String) getAttribute("title");
  }

  /**
   * @see reibach.rmi.Customer#setName(java.lang.String)
   */
  public void setCompany(String company) throws RemoteException
  {
  	setAttribute("company",company);
  }

  /**
   * @see reibach.rmi.Customer#getName()
   */
  public String getFirstname() throws RemoteException
  {
    return (String) getAttribute("firstname");
  }

  /**
   * @see reibach.rmi.Customer#setName(java.lang.String)
   */
  public void setFirstname(String firstname) throws RemoteException
  {
  	setAttribute("firstname",firstname);
  }


  /**
   * @see reibach.rmi.Customer#getName()
   */
  public String getLastname() throws RemoteException
  {
    return (String) getAttribute("lastname");
  }

  /**
   * @see reibach.rmi.Customer#setName(java.lang.String)
   */
  public void setLastname(String lastname) throws RemoteException
  {
  	setAttribute("lastname",lastname);
  }

  /**
   * @see reibach.rmi.Customer#getName()
   */
  public String getStreet() throws RemoteException
  {
    return (String) getAttribute("street");
  }

  /**
   * @see reibach.rmi.Customer#setName(java.lang.String)
   */
  public void setStreet(String street) throws RemoteException
  {
  	setAttribute("street",street);
  }

  /**
   * @see reibach.rmi.Customer#getName()
   */
  public String getHousenumber() throws RemoteException
  {
    return (String) getAttribute("housenumber");
  }

  /**
   * @see reibach.rmi.Customer#setName(java.lang.String)
   */
  public void setHousenumber(String housenumber) throws RemoteException
  {
  	setAttribute("housenumber",housenumber);
  }

  /**
   * @see reibach.rmi.Customer#getName()
   */
  public String getZipcode() throws RemoteException
  {
    return (String) getAttribute("zipcode");
  }

  /**
   * @see reibach.rmi.Customer#setName(java.lang.String)
   */
  public void setZipcode(String zipcode) throws RemoteException
  {
  	setAttribute("zipcode",zipcode);
  }

  /**
   * @see reibach.rmi.Customer#getName()
   */
  public String getPlace() throws RemoteException
  {
    return (String) getAttribute("place");
  }

  /**
   * @see reibach.rmi.Customer#setName(java.lang.String)
   */
  public void setPlace(String place) throws RemoteException
  {
  	setAttribute("place",place);
  }

  /**
   * @see reibach.rmi.Customer#getName()
   */
  public String getEmail() throws RemoteException
  {
    return (String) getAttribute("email");
  }

  /**
   * @see reibach.rmi.Customer#setName(java.lang.String)
   */
  public void setEmail(String email) throws RemoteException
  {
  	setAttribute("email",email);
  }

  /**
   * @see reibach.rmi.Customer#getName()
   */
  public String getTel() throws RemoteException
  {
    return (String) getAttribute("tel");
  }

  /**
   * @see reibach.rmi.Customer#setName(java.lang.String)
   */
  public void setTel(String tel) throws RemoteException
  {
  	setAttribute("tel",tel);
  }

  /**
   * @see reibach.rmi.Customer#getName()
   */
  public String getFax() throws RemoteException
  {
    return (String) getAttribute("fax");
  }

  /**
   * @see reibach.rmi.Customer#setName(java.lang.String)
   */
  public void setFax(String fax) throws RemoteException
  {
  	setAttribute("fax",fax);
  }

  /**
   * @see reibach.rmi.Customer#getName()
   */
  public String getMobil() throws RemoteException
  {
    return (String) getAttribute("mobil");
  }

  /**
   * @see reibach.rmi.Customer#setName(java.lang.String)
   */
  public void setMobil(String mobil) throws RemoteException
  {
  	setAttribute("mobil",mobil);
  }

  
  /**
   * @see reibach.rmi.Customer#getComment()
   */
  public String getComment() throws RemoteException
  {
    return (String) getAttribute("comment");
  }
 
  /**
   * @see reibach.rmi.Customer#setComment(java.lang.String)
   */
  public void setComment(String comment) throws RemoteException
  {
  	setAttribute("comment",comment);
  }



  
  /**
   * @see reibach.rmi.Customer#getCustomers()
   */
	public DBIterator getCustomers() throws RemoteException
	{
		try
  {
    // 1) Get the Database Service.
    DBService service = this.getService();

    // you can get the Database Service also via:
    // DBService service = this.getService();
    
    // 3) We create the task list using getList(Class)
    DBIterator customers = service.createList(Customer.class);
        
    return customers;
  }
  catch (Exception e)
  {
  	throw new RemoteException("unable to load customer list",e);
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


