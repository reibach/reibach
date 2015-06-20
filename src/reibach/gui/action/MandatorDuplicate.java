package reibach.gui.action;

import java.rmi.RemoteException;

import reibach.Settings;
import reibach.rmi.Mandator;

import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.util.ApplicationException;

/**
 * Action for "duplicate Mandator".
 */
public class MandatorDuplicate implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {

		if (context == null || !(context instanceof Mandator))
			throw new ApplicationException(Settings.i18n().tr("Please a mandator you want to duplicate"));

		Mandator mandator = null;
		try
		{
			// Lets create a new Mandator
			mandator = (Mandator) Settings.getDBService().createObject(Mandator.class,null);
		
			// copy the attributes into the new object.
			mandator.overwrite((Mandator)context);
		}
		catch (RemoteException e)
		{
			throw new ApplicationException(Settings.i18n().tr("Error while duplicating the mandator"),e);
		}

		// ok, lets start the dialog 
  	GUI.startView(reibach.gui.view.MandatorDetail.class.getName(),mandator);
  }

}