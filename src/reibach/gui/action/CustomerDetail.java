/**********************************************************************
 * $Source: /cvsroot/jameica/jameica_exampleplugin/src/de/willuhn/jameica/example/gui/action/CustomerDetail.java,v $
 * $Revision: 1.5 $
 * $Date: 2010-11-09 17:20:15 $
 * $Author: willuhn $
 * $Locker:  $
 * $State: Exp $
 *
 * Copyright (c) by willuhn.webdesign
 * All rights reserved
 *
 **********************************************************************/
package reibach.gui.action;

import java.rmi.RemoteException;

import reibach.Settings;
import reibach.rmi.Customer;

import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.util.ApplicationException;

/**
 * Action for "show Customer details" or "create new Customer".
 */
public class CustomerDetail implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {

		Customer customer = null;
		
		// check if the context is a customer
		if (context != null && (context instanceof Customer))
			customer = (Customer) context;
		

		// context null?
		// --> create a new customer
		if (context == null)
		{
			try
			{
				customer = (Customer) Settings.getDBService().createObject(Customer.class,null);
			}
			catch (RemoteException e)
			{
				throw new ApplicationException(Settings.i18n().tr("error while creating new customer"),e);
			}
		}

		// check if the context is a bill
		// --> create a new customer and assign the given bill
/*  	if (context != null && (context instanceof Bill))
  	{
			try
			{
				//Bill p = (Bill) context;
				//if (p.isNewObject())
					//throw new ApplicationException(Settings.i18n().tr("Please store the bill first"));
				customer = (Customer) Settings.getDBService().createObject(Customer.class,null);
				//customer.setBill(p);
			}
			catch (RemoteException e)
			{
				throw new ApplicationException(Settings.i18n().tr("Error while creating new customer"),e);
			}
  	}

*/
		// ok, lets start the dialog
  		GUI.startView(reibach.gui.view.CustomerDetail.class.getName(),customer);
  }

}


/**********************************************************************
 * $Log: CustomerDetail.java,v $
 * Revision 1.5  2010-11-09 17:20:15  willuhn
 * @N Beispiel-Plugin auf aktuellen Stand gebracht. Code-Cleanup und Beispiel-Implementierung fuer Search-API hinzugefuegt
 *
 **********************************************************************/