/**********************************************************************
 * $Source: /cvsroot/jameica/jameica_exampleplugin/src/de/willuhn/jameica/example/gui/action/PositionDuplicate.java,v $
 * $Revision: 1.2 $
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

import java.rmi.RemoteException;

import reibach.Settings;
import reibach.rmi.Position;

import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.util.ApplicationException;

/**
 * Action for "duplicate Position".
 */
public class PositionDuplicate implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {

		if (context == null || !(context instanceof Position))
			throw new ApplicationException(Settings.i18n().tr("Please a position you want to duplicate"));

		Position position = null;
		try
		{
			// Lets create a new Position
			position = (Position) Settings.getDBService().createObject(Position.class,null);
		
			// copy the attributes into the new object.
			position.overwrite((Position)context);
		}
		catch (RemoteException e)
		{
			throw new ApplicationException(Settings.i18n().tr("Error while duplicating the position"),e);
		}

		// ok, lets start the dialog 
  	GUI.startView(reibach.gui.view.PositionDetail.class.getName(),position);
  }

}


/**********************************************************************
 * $Log: PositionDuplicate.java,v $
 * Revision 1.2  2010-11-09 17:20:15  willuhn
 * @N Beispiel-Plugin auf aktuellen Stand gebracht. Code-Cleanup und Beispiel-Implementierung fuer Search-API hinzugefuegt
 *
 **********************************************************************/