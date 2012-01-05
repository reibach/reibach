package reibach.rmi;

import java.rmi.RemoteException;
import java.util.Date;

import de.willuhn.datasource.rmi.DBIterator;
import de.willuhn.datasource.rmi.DBObject;
import de.willuhn.util.ApplicationException;

public interface Bill extends DBObject
{

	  public Customer getCustomer() throws RemoteException;
	  public void setCustomer(Customer customer) throws RemoteException;
	  
	  public Mandator getMandator() throws RemoteException;
	  public void setMandator(Mandator mandator) throws RemoteException;
	  
	  public String getName() throws RemoteException;
	  public String getDescription() throws RemoteException;
	  public String getEmail() throws RemoteException;
	  public double getPrice() throws RemoteException;
	  public void BillPrintPdf() throws RemoteException, ApplicationException;
	  public Date getBillDate() throws RemoteException;
	  public void setName(String name) throws RemoteException;
	  public void setDescription(String description) throws RemoteException;
	  public void setPrice(double price) throws RemoteException;
	  public void setBillDate(Date billDate) throws RemoteException;
	  public DBIterator getPositions() throws RemoteException;
	  public double getEfforts() throws RemoteException;
}

