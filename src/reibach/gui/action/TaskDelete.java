package reibach.gui.action;

import reibach.Settings;
import reibach.rmi.Task;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.messaging.StatusBarMessage;
import de.willuhn.jameica.system.Application;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;

/**
 * Action for "delete task".
 */
public class TaskDelete implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {

		// check if the context is a project
  	if (context == null || !(context instanceof Task))
  		throw new ApplicationException(Settings.i18n().tr("Please choose a task you want to delete"));

    Task t = (Task) context;
    
    try
    {

			// before deleting the task, we show up a confirm dialog ;)
      // before deleting the project, we show up a confirm dialog ;)
      String question = Settings.i18n().tr("Do you really want to delete this task?");
      if (!Application.getCallback().askUser(question))
        return;
			
      t.delete();
      // Send Status update message
      Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Task deleted successfully"),StatusBarMessage.TYPE_SUCCESS));
    }
    catch (Exception e)
    {
      Logger.error("error while deleting task",e);
      throw new ApplicationException(Settings.i18n().tr("Error while deleting task"));
    }
  }

}

