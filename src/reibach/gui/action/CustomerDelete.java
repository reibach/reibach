/**********************************************************************
 * $Source: /cvsroot/jameica/jameica_exampleplugin/src/de/willuhn/jameica/example/gui/action/CustomerDelete.java,v $
 * $Revision: 1.3 $
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

import reibach.Settings;
import reibach.rmi.Customer;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.messaging.StatusBarMessage;
import de.willuhn.jameica.system.Application;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;

/**
 * Action for "delete customer".
 */
public class CustomerDelete implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {

		// check if the context is a project
  	if (context == null || !(context instanceof Customer))
  		throw new ApplicationException(Settings.i18n().tr("Please choose a customer you want to delete"));

    Customer t = (Customer) context;
    
    try
    {

			// before deleting the customer, we show up a confirm dialog ;)
      // before deleting the project, we show up a confirm dialog ;)
      String question = Settings.i18n().tr("Do you really want to delete this customer?");
      if (!Application.getCallback().askUser(question))
        return;
			
      t.delete();
      // Send Status update message
      Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Customer deleted successfully"),StatusBarMessage.TYPE_SUCCESS));
    }
    catch (Exception e)
    {
      Logger.error("error while deleting customer",e);
      throw new ApplicationException(Settings.i18n().tr("Error while deleting customer"));
    }
  }

}


/**********************************************************************
 * $Log: CustomerDelete.java,v $
 * Revision 1.3  2010-11-09 17:20:15  willuhn
 * @N Beispiel-Plugin auf aktuellen Stand gebracht. Code-Cleanup und Beispiel-Implementierung fuer Search-API hinzugefuegt
 *
 **********************************************************************/