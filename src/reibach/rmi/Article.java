package reibach.rmi;

import java.rmi.RemoteException;
import java.util.Date;

import de.willuhn.datasource.rmi.DBIterator;
import de.willuhn.datasource.rmi.DBObject;

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


