package reibach.gui.action;

import reibach.Settings;
import reibach.rmi.Position;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.messaging.StatusBarMessage;
import de.willuhn.jameica.system.Application;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;

/**
 * Action for "delete position".
 */
public class PositionDelete implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {

		// check if the context is a project
  	if (context == null || !(context instanceof Position))
  		throw new ApplicationException(Settings.i18n().tr("Please choose a position you want to delete"));

    Position p = (Position) context;
    
    try
    {

			// before deleting the position, we show up a confirm dialog ;)
      // before deleting the project, we show up a confirm dialog ;)
      String question = Settings.i18n().tr("Do you really want to delete this position?");
      if (!Application.getCallback().askUser(question))
        return;
			
      p.delete();
      // Send Status update message
      Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Position deleted successfully"),StatusBarMessage.TYPE_SUCCESS));
    }
    catch (Exception e)
    {
      Logger.error("error while deleting position",e);
      throw new ApplicationException(Settings.i18n().tr("Error while deleting position"));
    }
  }

}
