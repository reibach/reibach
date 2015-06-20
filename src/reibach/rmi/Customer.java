package reibach.rmi;

import java.rmi.RemoteException;
import java.util.Date;

import de.willuhn.datasource.rmi.DBIterator;
import de.willuhn.datasource.rmi.DBObject;


public interface Customer extends DBObject
{
   public String getCompany() throws RemoteException;
   public void setCompany(String company) throws RemoteException;
	 
   public String getTitle() throws RemoteException;
   public void setTitle(String title) throws RemoteException;

   public String getFirstname() throws RemoteException;
   public void setFirstname(String firstname) throws RemoteException;
	 
   public String getLastname() throws RemoteException;
   public void setLastname(String lastname) throws RemoteException;	 
   
   public String getStreet() throws RemoteException;
   public void setStreet(String street) throws RemoteException;
	 
   public String getHousenumber() throws RemoteException;
   public void setHousenumber(String housenumber) throws RemoteException;
	 
   public String getZipcode() throws RemoteException;
   public void setZipcode(String zipcode) throws RemoteException;
	 
   public String getPlace() throws RemoteException;
   public void setPlace(String place) throws RemoteException;
	 
   public String getEmail() throws RemoteException;
   public void setEmail(String email) throws RemoteException;
	 
   public String getTel() throws RemoteException;
   public void setTel(String tel) throws RemoteException;
	 
   public String getFax() throws RemoteException;
   public void setFax(String fax) throws RemoteException;
	 
   public String getMobil() throws RemoteException;
   public void setMobil(String mobil) throws RemoteException;
	 
   public String getComment() throws RemoteException;
   public void setComment(String comment) throws RemoteException;
   
}
