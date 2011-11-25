/**********************************************************************
 * $Source: /cvsroot/jameica/jameica_exampleplugin/src/de/willuhn/jameica/example/gui/menu/ArticleListMenu.java,v $
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
import reibach.gui.action.ArticleDelete;
import reibach.gui.action.ArticleDetail;
import reibach.gui.action.ArticleDuplicate;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.parts.CheckedContextMenuItem;
import de.willuhn.jameica.gui.parts.ContextMenu;
import de.willuhn.jameica.gui.parts.ContextMenuItem;
import de.willuhn.util.ApplicationException;

/**
 * Prepared context menu for article tables. 
 */
public class ArticleListMenu extends ContextMenu
{
	/**
   * ct.
   */
  public ArticleListMenu()
	{
		// CheckedContextMenuItems will be disabled, if the user clicks into an empty space of the table
		addItem(new CheckedContextMenuItem(Settings.i18n().tr("Open..."),new ArticleDetail()));

		// separator
		addItem(ContextMenuItem.SEPARATOR);

		addItem(new CheckedContextMenuItem(Settings.i18n().tr("Duplicate..."),new ArticleDuplicate()));

		addItem(new ContextMenuItem(Settings.i18n().tr("New..."),new Action()
		{
			public void handleAction(Object context) throws ApplicationException
			{
				// we force the context to be null to create a new article in any case
				new ArticleDetail().handleAction(null);
			}
		}));

		addItem(ContextMenuItem.SEPARATOR);
		addItem(new CheckedContextMenuItem(Settings.i18n().tr("Delete..."),new ArticleDelete()));

	}
}


/**********************************************************************
 * $Log: ArticleListMenu.java,v $
 * Revision 1.2  2010-11-09 17:20:16  willuhn
 * @N Beispiel-Plugin auf aktuellen Stand gebracht. Code-Cleanup und Beispiel-Implementierung fuer Search-API hinzugefuegt
 *
 **********************************************************************/