package reibach.gui.action;

import java.rmi.RemoteException;

import reibach.Settings;
import reibach.rmi.Project;
import reibach.rmi.Task;


import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.util.ApplicationException;

/**
 * Action for "show Task details" or "create new Task".
 */
public class TaskDetail implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {

		Task task = null;
		
		// check if the context is a task
		if (context != null && (context instanceof Task))
			task = (Task) context;
		

		// context null?
		// --> create a new task
		if (context == null)
		{
			try
			{
				task = (Task) Settings.getDBService().createObject(Task.class,null);
			}
			catch (RemoteException e)
			{
				throw new ApplicationException(Settings.i18n().tr("error while creating new task"),e);
			}
		}

		// check if the context is a project
		// --> create a new task and assign the given project
  	if (context != null && (context instanceof Project))
  	{
			try
			{
				Project p = (Project) context;
				if (p.isNewObject())
					throw new ApplicationException(Settings.i18n().tr("Please store the project first"));
				task = (Task) Settings.getDBService().createObject(Task.class,null);
				task.setProject(p);
			}
			catch (RemoteException e)
			{
				throw new ApplicationException(Settings.i18n().tr("Error while creating new task"),e);
			}
  	}


		// ok, lets start the dialog
  	GUI.startView(reibach.gui.view.TaskDetail.class.getName(),task);
  }

}

