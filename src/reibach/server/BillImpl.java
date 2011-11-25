package reibach.server;

import java.rmi.RemoteException;
import java.util.Date;

import reibach.Settings;
import reibach.rmi.Bill;
import reibach.rmi.Customer;
import reibach.rmi.Position;
import reibach.rmi.Project;

import de.willuhn.datasource.db.AbstractDBObject;
import de.willuhn.datasource.rmi.DBIterator;
import de.willuhn.datasource.rmi.DBService;
import de.willuhn.datasource.rmi.ObjectNotFoundException;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;


/**
 * This is the implemtor of the bill interface.
 * You never need to instanciate this class directly.
 * Instead of this, use the dbService to find the right
 * implementor of your interface.
 * Example:
 * 
 * DBService service = (DBService) Application.getServiceFactory().lookup(ReibachPlugin.class,"exampledatabase");
 * 
 * a) create new bill
 * Bill bill = (Bill) service.createObject(Bill.class,null);
 * 
 * b) load existing bill with id "4".
 * Bill bill = (Bill) service.createObject(Bill.class,"4");
 * 
 * c) list existing bills
 * DBIterator bills = service.createList(Bill.class);
 */
public class BillImpl extends AbstractDBObject implements Bill
{

	/**
   * @throws RemoteException
   */
  public BillImpl() throws RemoteException
  {
    super();
  }

  /**
   * We have to return the name of the sql table here.
	 * @see de.willuhn.datasource.db.AbstractDBObject#getTableName()
	 */
	protected String getTableName()
	{
		return "bill";
	}

  /**
   * Sometimes you can display only one of the bills attributes (in combo boxes).
   * Here you can define the name of this field.
   * Please dont confuse this with the "primary KEY".
   * @see de.willuhn.datasource.GenericObject#getPrimaryAttribute()
	 */
	public String getPrimaryAttribute() throws RemoteException
	{
    // we choose the bills name as primary field.
		return "name";
	}

	/**
   * This method will be called, before delete() is executed.
   * Here you can make some dependency checks.
   * If you dont want to delete the bill (in case of failed dependencies)
   * you have to throw an ApplicationException. The message of this
   * one will be shown in users UI. So please translate the text into
   * the users language.
	 * @see de.willuhn.datasource.db.AbstractDBObject#deleteCheck()
	 */
	protected void deleteCheck() throws ApplicationException
	{
  }

	/**
   * This method is invoked before executing insert().
   * So lets check the entered data.
	 * @see de.willuhn.datasource.db.AbstractDBObject#insertCheck()
	 */
	protected void insertCheck() throws ApplicationException
	{
    try {
      if (getName() == null || getName().length() == 0)
        throw new ApplicationException(Settings.i18n().tr("Please enter a bill name"));
     
    }
    catch (RemoteException e)
    {
      Logger.error("insert check of bill failed",e);
      throw new ApplicationException(Settings.i18n().tr("unable to store bill, please check the system log"));
    }
	}

	/**
   * This method is invoked before every update().
	 * @see de.willuhn.datasource.db.AbstractDBObject#updateCheck()
	 */
	protected void updateCheck() throws ApplicationException
	{
    // we simply call the insertCheck here ;)
    insertCheck();
	}

	/**
	 * @see de.willuhn.datasource.db.AbstractDBObject#getForeignObject(java.lang.String)
	
	protected Class getForeignObject(String arg0) throws RemoteException
	{
    // We dont have any foreign keys here. Please check PositionImpl.java
    // if you want to see an example.
		return super.getForeignObject(arg0);
	}
	 */

	 /**
	   * @see reibach.rmi.Bill#getCustomer
	   */
	  public Customer getCustomer() throws RemoteException
	  {
	  	// Yes, we can cast this directly to Customer, because getForeignObject(String)
	  	// contains the mapping for this attribute.
	  	try
	  	{
				return (Customer) getAttribute("customer_id");
	  	}
	  	catch (ObjectNotFoundException e)
	  	{
	  		return null;
	  	}
	  }

	  /**
	   * @see de.willuhn.datasource.db.AbstractDBObject#getForeignObject(java.lang.String)
	   */
	  protected Class getForeignObject(String field) throws RemoteException
	  {
			// the system is able to resolve foreign keys and loads
			// the according objects automatically. You only have to
			// define which class handles which foreign key.
	  	if ("customer_id".equals(field))
	  		return Customer.class;
	    return null;
	  }


	/**
	 * @see reibach.rmi.Bill#getName()
	 */
	public String getName() throws RemoteException
	{
    // Wen can cast this directly to String, the method getField() knows the
    // meta data of this sql table ;)
		return (String) getAttribute("name"); // "name" ist the sql field name
	}

	
	/**
	 * @see reibach.rmi.Bill#getDescription()
	 */
	public String getDescription() throws RemoteException
	{
		return (String) getAttribute("description");
	}

	/**
	 * @see reibach.rmi.Bill#getEmail()
	 */
	public String getEmail() throws RemoteException
	{
    return (String) getAttribute("email");
	}

	/**
	 * @see reibach.rmi.Bill#getPrice()
	 */
	public double getPrice() throws RemoteException
	{
    // AbstractDBObject will create a java.lang.Double.
    // We only have to cast it.
    Double d = (Double) getAttribute("price");
    return d == null || Double.isNaN(d) ? 0.0 : d.doubleValue();
	}

	/**
	 * @see reibach.rmi.Bill#getBillDate()
	 */
	public Date getBillDate() throws RemoteException
	{
		// getField() knows this type too
		return (Date) getAttribute("billdate");
	}

	/**
	 * @see reibach.rmi.Bill#setName(java.lang.String)
	 */
	public void setName(String name) throws RemoteException
	{
    // Please use setField(<fieldname>,<value>) to store the data into the right field.
    setAttribute("name",name);
	}


	/**
	 * @see reibach.rmi.Bill#setCustomer(java.lang.String)
	 */
	public void setCustomer(Customer customer) throws RemoteException
	{
    // Please use setField(<fieldname>,<value>) to store the data into the right field.
    	setAttribute("customer_id",customer);
	}


	/**
	 * @see reibach.rmi.Bill#setDescription(java.lang.String)
	 */
	public void setDescription(String description) throws RemoteException
	{
    setAttribute("description",description);
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

	/**
	 * @see reibach.rmi.Bill#setStartDate(java.util.Date)
	 */
	public void setBillDate(Date billDate) throws RemoteException
	{
    setAttribute("billdate",billDate);
	}

	/**
	 * @see reibach.rmi.Bill#getPositions()
	 */
	public DBIterator getPositions() throws RemoteException
	{
    try
    {
      // 1) Get the Database Service.
      DBService service = this.getService();

      // you can get the Database Service also via:
      // DBService service = this.getService();
      
      // 3) We create the position list using getList(Class)
      DBIterator positions = service.createList(Position.class);
      
      // 4) we add a filter to only query for positions with our bill id
      positions.addFilter("bill_id = " + this.getID());
      
      return positions;
    }
    catch (Exception e)
    {
    	throw new RemoteException("unable to load position list",e);
    }
	}

  /**
   * @see reibach.rmi.Bill#getEfforts()
   */
  public double getEfforts() throws RemoteException
  {
  	double sum = 0.0;
  	DBIterator i = getPositions();
  	while (i.hasNext())
  	{
  		Position t = (Position) i.next();
  		sum += t.getPrice();
  	}
  	return sum;
  }

  /**
   * We overwrite the delete method to delete all assigned positions too.
   * @see de.willuhn.datasource.rmi.Changeable#delete()
   */
  public void delete() throws RemoteException, ApplicationException
  {
  	try
  	{
  		// we start a new transaction
  		// to delete all or nothing
  		this.transactionBegin();

			DBIterator positions = getPositions();
			while (positions.hasNext())
			{
				Position t = (Position) positions.next();
				t.delete();
			}
			super.delete(); // we delete the bill itself

			// everything seems to be ok, lets commit the transaction
			this.transactionCommit();

  	}
  	catch (RemoteException re)
  	{
  		this.transactionRollback();
  		throw re;
  	}
  	catch (ApplicationException ae)
  	{
			this.transactionRollback();
  		throw ae;
  	}
  	catch (Throwable t)
  	{
			this.transactionRollback();
  		throw new ApplicationException(Settings.i18n().tr("error while deleting bill"),t);
  	}
  }

  /**
   * @see de.willuhn.datasource.GenericObject#getAttribute(java.lang.String)
   */
  public Object getAttribute(String fieldName) throws RemoteException
  {
		// You are able to create virtual object attributes by overwriting
		// this method. Just catch the fieldName and invent your own attributes ;)
		if ("summary".equals(fieldName))
		{
			return new Double(getPrice() * getEfforts());
		}

    return super.getAttribute(fieldName);
  }

}
