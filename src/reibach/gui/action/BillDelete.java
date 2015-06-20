package reibach.gui.action;

import reibach.Settings;
import reibach.rmi.Bill;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.messaging.StatusBarMessage;
import de.willuhn.jameica.system.Application;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;

/**
 * Action for "delete bill".
 */
public class BillDelete implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {

		// check if the context is a bill
  	if (context == null || !(context instanceof Bill))
  		throw new ApplicationException(Settings.i18n().tr("Please choose a bill"));

    Bill p = (Bill) context;
    
    try
    {

			// before deleting the bill, we show up a confirm dialog ;)
			String question = Settings.i18n().tr("Do you really want to delete this bill? " +
	                                         "All assigned tasks will be deleted too.");
			if (!Application.getCallback().askUser(question))
			  return;

      p.delete();
      
      // Send Status update message
      Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Bill deleted successfully"),StatusBarMessage.TYPE_SUCCESS));
    }
    catch (ApplicationException ae)
    {
      throw ae;
    }
    catch (Exception e)
    {
      Logger.error("error while deleting bill",e);
      throw new ApplicationException(Settings.i18n().tr("Error while deleting bill"));
    }
  }

}