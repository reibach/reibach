package reibach.server;

import java.rmi.RemoteException;

import reibach.Settings;
import reibach.rmi.Bill;
import reibach.rmi.Position;

import de.willuhn.datasource.db.AbstractDBObject;
import de.willuhn.datasource.rmi.ObjectNotFoundException;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;

/**
 * Implementation of the position interface.
 * Look into BillImpl for more code comments.
 */
public class PositionImpl extends AbstractDBObject implements Position
{

  /**
   * ct.
   * @throws RemoteException
   */
  public PositionImpl() throws RemoteException
  {
    super();
  }

  /**
   * @see de.willuhn.datasource.db.AbstractDBObject#getTableName()
   */
  protected String getTableName()
  {
  	// this is the sql table name.
    return "position";
  }

  /**
   * @see de.willuhn.datasource.GenericObject#getPrimaryAttribute()
   */
  public String getPrimaryAttribute() throws RemoteException
  {
  	// our primary attribute is the name.
    return "name";
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
			if (getName() == null || getName().length() == 0)
				throw new ApplicationException(Settings.i18n().tr("Please enter a position name"));
			
			if (getBill() == null)
				throw new ApplicationException(Settings.i18n().tr("Please choose a bill"));

			if (getBill().isNewObject())
				throw new ApplicationException(Settings.i18n().tr("Please store bill first"));

		}
		catch (RemoteException e)
		{
			Logger.error("insert check of bill failed",e);
			throw new ApplicationException(Settings.i18n().tr("unable to store bill, please check the system log"));
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
   * @see de.willuhn.datasource.db.AbstractDBObject#getForeignObject(java.lang.String)
   */
  protected Class getForeignObject(String field) throws RemoteException
  {
		// the system is able to resolve foreign keys and loads
		// the according objects automatically. You only have to
		// define which class handles which foreign key.
  	if ("bill_id".equals(field))
  		return Bill.class;
    return null;
  }

  /**
   * @see reibach.rmi.Position#getBill()
   */
  public Bill getBill() throws RemoteException
  {
  	// Yes, we can cast this directly to Bill, because getForeignObject(String)
  	// contains the mapping for this attribute.
  	try
  	{
			return (Bill) getAttribute("bill_id");
  	}
  	catch (ObjectNotFoundException e)
  	{
  		return null;
  	}
  }

  /**
   * @see reibach.rmi.Position#setBill(reibach.rmi.Bill)
   */
  public void setBill(Bill bill) throws RemoteException
  {
  	// same here
  	setAttribute("bill_id",bill);
  }

  /**
   * @see reibach.rmi.Position#getName()
   */
  public String getName() throws RemoteException
  {
    return (String) getAttribute("name");
  }

  /**
   * @see reibach.rmi.Position#setName(java.lang.String)
   */
  public void setName(String name) throws RemoteException
  {
  	setAttribute("name",name);
  }

  /**
   * @see reibach.rmi.Position#getComment()
   */
  public String getComment() throws RemoteException
  {
    return (String) getAttribute("comment");
  }

  /**
   * @see reibach.rmi.Position#setComment(java.lang.String)
   */
  public void setComment(String comment) throws RemoteException
  {
	  setAttribute("comment",comment);
  }
	
  
/**
 * @see reibach.rmi.Position#getUnit()
 */
public String getUnit() throws RemoteException
{
  return (String) getAttribute("unit");
}

/**
 * @see reibach.rmi.Position#setUnit(java.lang.String)
 */
public void setUnit(String unit) throws RemoteException
{
	setAttribute("unit", unit);
}



public double getQuantity() throws RemoteException
{
	  // AbstractDBObject will create a java.lang.Double.
	  // We only have to cast it.
	  Double d = (Double) getAttribute("quantity");
	  return d == null || Double.isNaN(d) ? 0.0 : d.doubleValue();
}

/**
 * @see reibach.rmi.Bill#setQuantity(double)
 */
public void setQuantity(double quantity) throws RemoteException
{
    setAttribute("quantity",new Double(quantity));
}



/**
	 * @see reibach.rmi.Bill#getPrice()
	 */
	public double getPrice() throws RemoteException
	{
	  // AbstractDBObject will create a java.lang.Double.
	  // We only have to cast it.
	  Double d = (Double) getAttribute("price");
	  return d == null || Double.isNaN(d) ? 0.00 : d.doubleValue();
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
	 * @see reibach.rmi.Bill#getTax()
	 */
	public double getTax() throws RemoteException
	{
	  // AbstractDBObject will create a java.lang.Double.
	  // We only have to cast it.
	  Double d = (Double) getAttribute("tax");
	  return d == null || Double.isNaN(d) ? 0.0 : d.doubleValue();
	}

	/**
	 * @see reibach.rmi.Bill#setTax(double)
	 */
	public void setTax(double tax) throws RemoteException
	{
	    // setField() wants to have an object but <prive> is a primitive type.
	    // So we have to make a java.lang.Double
	    setAttribute("tax",new Double(tax));
	}
	  /**
	 * @see reibach.rmi.Bill#getAmount()
	 */
	public double getAmount() throws RemoteException
	{
	  // AbstractDBObject will create a java.lang.Double.
	  // We only have to cast it.
	  Double d = (Double) getAttribute("amount");
	  return d == null || Double.isNaN(d) ? 0.0 : d.doubleValue();
	}

	/**
	 * @see reibach.rmi.Bill#setAmount(double)
	 */
	public void setAmount(double amount) throws RemoteException
	{
	    // setField() wants to have an object but <prive> is a primitive type.
	    // So we have to make a java.lang.Double
	    setAttribute("amount",new Double(amount));
	}


	
	
	
	/**
	 * @see reibach.rmi.Bill#getPos_num()
	 */
	public String getPos_num() throws RemoteException
	{
		  return (String) getAttribute("pos_num");
	}

	/**
	 * @see reibach.rmi.Bill#setPos_num(double)
	 */
	public void setPos_num(String pos_num) throws RemoteException
	{
	    // setField() wants to have an object but <prive> is a primitive type.
	    // So we have to make a java.lang.Double
	    setAttribute("pos_num", pos_num);
	}

}


/**********************************************************************
 * $Log: PositionImpl.java,v $
 * Revision 1.4  2010-11-09 17:20:16  willuhn
 * @N Beispiel-Plugin auf aktuellen Stand gebracht. Code-Cleanup und Beispiel-Implementierung fuer Search-API hinzugefuegt
 *
 **********************************************************************/