/**********************************************************************
 * $Source: /cvsroot/jameica/jameica_exampleplugin/src/de/willuhn/jameica/example/rmi/Position.java,v $
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

package reibach.rmi;

import java.rmi.RemoteException;

import de.willuhn.datasource.rmi.DBObject;


/**
 * Interface of the business object for positions.
 * According to the SQL table, we define some getter an setter here.
 * <pre>
 * CREATE TABLE position (
 *   id NUMERIC default UNIQUEKEY('position'),
 *   bill_id int(4) NOT NULL,
 *   name varchar(255) NOT NULL,
 *   comment text NOT NULL,
 *   effort double,
 *   UNIQUE (id),
 *   PRIMARY KEY (id)
 * );
 * </pre>
 * <br>Getters and setters for the primary key (id) are not needed.
 * Every one of the following methods has to throw a RemoteException.
 * <br>
 */
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

  public double getPrice() throws RemoteException;
  public void setPrice( double price) throws RemoteException;
 
  public String getComment() throws RemoteException;
  public void setComment(String comment) throws RemoteException;
  

}


/**********************************************************************
 * $Log: Position.java,v $
 * Revision 1.3  2010-11-09 17:20:16  willuhn
 * @N Beispiel-Plugin auf aktuellen Stand gebracht. Code-Cleanup und Beispiel-Implementierung fuer Search-API hinzugefuegt
 *
 **********************************************************************/