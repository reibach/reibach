package reibach.gui.action;

import java.rmi.RemoteException;

import reibach.Settings;
import reibach.rmi.Mandator;

import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.util.ApplicationException;

/**
 * Action for "show Mandator details" or "create new Mandator".
 */
public class MandatorDetail implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {

		Mandator mandator = null;
		
		// check if the context is a mandator
		if (context != null && (context instanceof Mandator))
			mandator = (Mandator) context;
		

		// context null?
		// --> create a new mandator
		if (context == null)
		{
			try
			{
				mandator = (Mandator) Settings.getDBService().createObject(Mandator.class,null);
			}
			catch (RemoteException e)
			{
				throw new ApplicationException(Settings.i18n().tr("error while creating new mandator"),e);
			}
		}

		// check if the context is a bill
		// --> create a new mandator and assign the given bill
/*  	if (context != null && (context instanceof Bill))
  	{
			try
			{
				//Bill p = (Bill) context;
				//if (p.isNewObject())
					//throw new ApplicationException(Settings.i18n().tr("Please store the bill first"));
				mandator = (Mandator) Settings.getDBService().createObject(Mandator.class,null);
				//mandator.setBill(p);
			}
			catch (RemoteException e)
			{
				throw new ApplicationException(Settings.i18n().tr("Error while creating new mandator"),e);
			}
  	}

*/
		// ok, lets start the dialog
  		GUI.startView(reibach.gui.view.MandatorDetail.class.getName(),mandator);
  }

}