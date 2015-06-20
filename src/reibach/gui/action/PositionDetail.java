package reibach.gui.action;

import java.rmi.RemoteException;

import reibach.Settings;
import reibach.rmi.Bill;
import reibach.rmi.Position;

import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.util.ApplicationException;

/**
 * Action for "show Position details" or "create new Position".
 */
public class PositionDetail implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {

		Position position = null;
		
		// check if the context is a position
		if (context != null && (context instanceof Position))
			position = (Position) context;
		

		// context null?
		// --> create a new position
		if (context == null)
		{
			try
			{
				position = (Position) Settings.getDBService().createObject(Position.class,null);
			}
			catch (RemoteException e)
			{
				throw new ApplicationException(Settings.i18n().tr("error while creating new position"),e);
			}
		}

		// check if the context is a bill
		// --> create a new position and assign the given bill
  	if (context != null && (context instanceof Bill))
  	{
			try
			{
				Bill p = (Bill) context;
				if (p.isNewObject())
					throw new ApplicationException(Settings.i18n().tr("Please store the bill first"));
				position = (Position) Settings.getDBService().createObject(Position.class,null);
				position.setBill(p);
			}
			catch (RemoteException e)
			{
				throw new ApplicationException(Settings.i18n().tr("Error while creating new position"),e);
			}
  	}


		// ok, lets start the dialog
  	GUI.startView(reibach.gui.view.PositionDetail.class.getName(),position);
  }

}
