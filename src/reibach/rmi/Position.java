package reibach.rmi;

import java.rmi.RemoteException;

import de.willuhn.datasource.rmi.DBObject;

public interface Position extends DBObject
{
	/**
	 * Returns the bill for this position.
   * @return the bill.
   * @throws RemoteException
   */
  public Bill getBill() throws RemoteException;
	
	/**
	 * Stores the Bill for this position.
   * @param bill
   * @throws RemoteException
   */
  public void setBill(Bill bill) throws RemoteException;

  public String getName() throws RemoteException;
  public void setName(String name) throws RemoteException;

  public String getUnit() throws RemoteException;
  public void setUnit(String unit) throws RemoteException;

  public double getTax() throws RemoteException;
  public void setTax( double tax) throws RemoteException;
 
  public double getAmount() throws RemoteException;
  public void setAmount( double amount) throws RemoteException;
 
  public double getPrice() throws RemoteException;
  public void setPrice( double price) throws RemoteException;
 
  public String getPos_num() throws RemoteException;
  public void setPos_num( String pos_num) throws RemoteException;

  public String getID() throws RemoteException;
  public void setID( String id) throws RemoteException;

  public double getQuantity() throws RemoteException;
  public void setQuantity( double quantity) throws RemoteException;

  public String getComment() throws RemoteException;
  public void setComment(String comment) throws RemoteException;
  

}


/**********************************************************************
 * $Log: Position.java,v $
 * Revision 1.3  2010-11-09 17:20:16  willuhn
 * @N Beispiel-Plugin auf aktuellen Stand gebracht. Code-Cleanup und Beispiel-Implementierung fuer Search-API hinzugefuegt
 *
 **********************************************************************/