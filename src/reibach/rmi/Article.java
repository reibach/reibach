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
public interface Article extends DBObject
{
   public String getName() throws RemoteException;
   public void setName(String name) throws RemoteException;
 
   public double getPrice() throws RemoteException;
   public void setPrice( double price) throws RemoteException;
  

   public String getUnit() throws RemoteException;
   public void setUnit(String unit) throws RemoteException;

   public String getComment() throws RemoteException;
   public void setComment(String comment) throws RemoteException;
   
}


