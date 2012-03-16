package reibach.rmi;

import java.rmi.RemoteException;
import java.util.Date;

import de.willuhn.datasource.rmi.DBIterator;
import de.willuhn.datasource.rmi.DBObject;


public interface Mandator extends DBObject
{
	   public String getCompany() throws RemoteException;
	   public void setCompany(String company) throws RemoteException;
		 
	   public String getSlogan() throws RemoteException;
	   public void setSlogan(String slogan) throws RemoteException;
			 
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
		 
	   public String getWebsite() throws RemoteException;
	   public void setWebsite(String website) throws RemoteException;
		 
	   public String getTel() throws RemoteException;
	   public void setTel(String tel) throws RemoteException;
		 
	   public String getFax() throws RemoteException;
	   public void setFax(String fax) throws RemoteException;
		 
	   public String getMobil() throws RemoteException;
	   public void setMobil(String mobil) throws RemoteException;
		 
	   public String getComment() throws RemoteException;
	   public void setComment(String comment) throws RemoteException;	   
	
	   public String getBankname() throws RemoteException;
	   public void setBankname(String bankname) throws RemoteException;
	   
	   public String getBankaccount() throws RemoteException;
	   public void setBankaccount(String bankaccount) throws RemoteException;
	   
	   public String getBankcodenumber() throws RemoteException;
	   public void setBankcodenumber(String bankcodenumber) throws RemoteException;
	   
	   public String getIban() throws RemoteException;
	   public void setIban(String iban) throws RemoteException;
	   
	   public String getBic() throws RemoteException;
	   public void setBic(String bic) throws RemoteException;
	   
	   public String getTaxoffice() throws RemoteException;
	   public void setTaxoffice(String taxoffice) throws RemoteException;
	   
	   public String getTaxnumber() throws RemoteException;
	   public void setTaxnumber(String taxnumber) throws RemoteException;
	   
	   public String getVatnumber() throws RemoteException;
	   public void setVatnumber(String vatnumber) throws RemoteException;
   
}
