/**********************************************************************
 * $Source: /cvsroot/jameica/jameica_exampleplugin/src/de/willuhn/jameica/example/gui/action/CustomerDuplicate.java,v $
 * $Revision: 1.2 $
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
 * Action for "duplicate Customer".
 */
public class CustomerDuplicate implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {

		if (context == null || !(context instanceof Customer))
			throw new ApplicationException(Settings.i18n().tr("Please a customer you want to duplicate"));

		Customer customer = null;
		try
		{
			// Lets create a new Customer
			customer = (Customer) Settings.getDBService().createObject(Customer.class,null);
		
			// copy the attributes into the new object.
			customer.overwrite((Customer)context);
		}
		catch (RemoteException e)
		{
			throw new ApplicationException(Settings.i18n().tr("Error while duplicating the customer"),e);
		}

		// ok, lets start the dialog 
  	GUI.startView(reibach.gui.view.CustomerDetail.class.getName(),customer);
  }

}


/**********************************************************************
 * $Log: CustomerDuplicate.java,v $
 * Revision 1.2  2010-11-09 17:20:15  willuhn
 * @N Beispiel-Plugin auf aktuellen Stand gebracht. Code-Cleanup und Beispiel-Implementierung fuer Search-API hinzugefuegt
 *
 **********************************************************************/