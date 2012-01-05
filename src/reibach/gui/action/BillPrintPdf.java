package reibach.gui.action;

import reibach.Settings;
import reibach.rmi.Bill;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.jameica.messaging.StatusBarMessage;
import de.willuhn.jameica.system.Application;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;

/**
 * Action for "print bill".
 */
public class BillPrintPdf implements Action
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

    	p.BillPrintPdf();
		    
      // Send Status update message
      Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Bill printing successfully"),StatusBarMessage.TYPE_SUCCESS));
    }
    catch (ApplicationException ae)
    {
      throw ae;
    }
    catch (Exception e)
    {
    	Logger.error("error while printing bill",e);
    	throw new ApplicationException(Settings.i18n().tr("Error while printing bill from gui.action.BillPrintPdf"));
    }
		// ok, lets start the dialog
		GUI.startView(reibach.gui.view.BillDetail.class.getName(),p);
  	}
}