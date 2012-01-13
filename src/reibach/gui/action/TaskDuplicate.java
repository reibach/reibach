package reibach.gui.action;

import java.rmi.RemoteException;

import reibach.Settings;
import reibach.rmi.Task;


import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.util.ApplicationException;

/**
 * Action for "duplicate Task".
 */
public class TaskDuplicate implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {

		if (context == null || !(context instanceof Task))
			throw new ApplicationException(Settings.i18n().tr("Please a task you want to duplicate"));

		Task task = null;
		try
		{
			// Lets create a new Task
			task = (Task) Settings.getDBService().createObject(Task.class,null);
		
			// copy the attributes into the new object.
			task.overwrite((Task)context);
		}
		catch (RemoteException e)
		{
			throw new ApplicationException(Settings.i18n().tr("Error while duplicating the task"),e);
		}

		// ok, lets start the dialog 
  	GUI.startView(reibach.gui.view.TaskDetail.class.getName(),task);
  }

}

