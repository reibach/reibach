/**********************************************************************
 * $Source: /cvsroot/jameica/jameica_exampleplugin/src/de/willuhn/jameica/example/gui/menu/PositionListMenu.java,v $
 * $Revision: 1.2 $
 * $Date: 2010-11-09 17:20:16 $
 * $Author: willuhn $
 * $Locker:  $
 * $State: Exp $
 *
 * Copyright (c) by willuhn.webdesign
 * All rights reserved
 *
 **********************************************************************/
package reibach.gui.menu;

import reibach.Settings;
import reibach.gui.action.PositionDelete;
import reibach.gui.action.PositionDetail;
import reibach.gui.action.PositionDuplicate;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.parts.CheckedContextMenuItem;
import de.willuhn.jameica.gui.parts.ContextMenu;
import de.willuhn.jameica.gui.parts.ContextMenuItem;
import de.willuhn.util.ApplicationException;

/**
 * Prepared context menu for position tables. 
 */
public class PositionListMenu extends ContextMenu
{
	/**
   * ct.
   */
  public PositionListMenu()
	{
		// CheckedContextMenuItems will be disabled, if the user clicks into an empty space of the table
		addItem(new CheckedContextMenuItem(Settings.i18n().tr("Open..."),new PositionDetail()));

		// separator
		addItem(ContextMenuItem.SEPARATOR);

		addItem(new CheckedContextMenuItem(Settings.i18n().tr("Duplicate..."),new PositionDuplicate()));

		addItem(new ContextMenuItem(Settings.i18n().tr("New..."),new Action()
		{
			public void handleAction(Object context) throws ApplicationException
			{
				// we force the context to be null to create a new position in any case
				new PositionDetail().handleAction(null);
			}
		}));

		addItem(ContextMenuItem.SEPARATOR);
		addItem(new CheckedContextMenuItem(Settings.i18n().tr("Delete..."),new PositionDelete()));

	}
}


/**********************************************************************
 * $Log: PositionListMenu.java,v $
 * Revision 1.2  2010-11-09 17:20:16  willuhn
 * @N Beispiel-Plugin auf aktuellen Stand gebracht. Code-Cleanup und Beispiel-Implementierung fuer Search-API hinzugefuegt
 *
 **********************************************************************/