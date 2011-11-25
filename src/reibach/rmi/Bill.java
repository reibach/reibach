/**********************************************************************
 * $Source: /cvsroot/jameica/jameica_exampleplugin/src/de/willuhn/jameica/example/rmi/Bill.java,v $
 * $Revision: 1.5 $
 * $Date: 2010-11-09 17:20:16 $
 * $Author: willuhn $
 * $Locker:  $
 * $State: Exp $
 *
 * Copyright (c) by willuhn.webdesign
 * All rights reserved
 *
 **********************************************************************/

package reibach.rmi;

import java.rmi.RemoteException;
import java.util.Date;

import de.willuhn.datasource.rmi.DBIterator;
import de.willuhn.datasource.rmi.DBObject;


/**
 * Interface of the business object for bills.
 * According to the SQL table, we define some getter an setter here.
 * <pre>
 * CREATE TABLE bill (
 *   id NUMERIC default UNIQUEKEY('bill'),
 *   name varchar(255) NOT NULL,
 *   description text NOT NULL,
 *   email varchar(255) NOT NULL,
 *   price double,
 *   startdate date,
 *   enddate date,
 *   UNIQUE (id),
 *   PRIMARY KEY (id)
 * );
 * </pre>
 * <br>Getters and setters for the primary key (id) are not needed.
 * Every one of the following methods has to throw a RemoteException.
 * <br>
 */
public interface Bill extends DBObject
{

	/**
	 * Returns the Customer for this task.
   * @return the project.
   * @throws RemoteException
   */
  public Customer getCustomer() throws RemoteException;
		
	/**
	 * Stores the Project for this task.
   * @param project
   * @throws RemoteException
   */
  public void setCustomer(Customer customer) throws RemoteException;
  
  
  /**
   * Returns the name of the bill.
   * @return name of the bill.
   * @throws RemoteException
   */
  public String getName() throws RemoteException;
  
  /**
   * Returns the description text of the bill.
   * @return description of the bill.
   * @throws RemoteException
   */
  public String getDescription() throws RemoteException;
  
  /**
   * Returns the email of the bill contact.
   * @return email of bill contact.
   * @throws RemoteException
   */
  public String getEmail() throws RemoteException;
  
  /**
   * Returns the price per hour for the bill.
   * @return price.
   * @throws RemoteException
   */
  public double getPrice() throws RemoteException;
  
  /**
   * Returns the start date of the bill.
   * @return start date.
   * @throws RemoteException
   */
  public Date getBillDate() throws RemoteException;
  
  /**
   * Sets the name of the bill.
   * @param name name of the bill.
   * @throws RemoteException
   */
  public void setName(String name) throws RemoteException;
  
  /**
   * Sets the description  of the bill.
   * @param description description  of the bill.
   * @throws RemoteException
   */
  public void setDescription(String description) throws RemoteException;
  
  /**
   * Sets the price of the bill.
   * @param price price of the bill.
   * @throws RemoteException
   */
  public void setPrice(double price) throws RemoteException;
  
  /**
   * Sets the start date of the bill.
   * @param billDate of the bill.
   * @throws RemoteException
   */
  public void setBillDate(Date billDate) throws RemoteException;
  
  /**
   * Additionally we want to have a method that fetches all positions from this bill.
   * @return list of all positions within this bill.
   * @throws RemoteException
   */
  public DBIterator getPositions() throws RemoteException;
  
  /**
   * Returns the effort summary from all positions of this bill. 
   * @return effort summary from all positions of this bill.
   * @throws RemoteException
   */
  public double getEfforts() throws RemoteException;

  

}

