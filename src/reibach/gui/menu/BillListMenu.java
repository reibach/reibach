package reibach.gui.menu;

import reibach.gui.action.ProjectDelete;
import reibach.gui.action.ProjectDetail;
import reibach.gui.action.TaskDetail;
import reibach.Settings;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.parts.CheckedContextMenuItem;
import de.willuhn.jameica.gui.parts.ContextMenu;
import de.willuhn.jameica.gui.parts.ContextMenuItem;
import de.willuhn.util.ApplicationException;

/**
 * Prepared context menu for project tables. 
 */
public class BillListMenu extends ContextMenu
{
	/**
   * ct.
   */
  public BillListMenu()
	{
		// CheckedContextMenuItems will be disabled, if the user clicks into an empty space of the table
		addItem(new CheckedContextMenuItem(Settings.i18n().tr("Open..."),new ProjectDetail()));

		// separator
		addItem(ContextMenuItem.SEPARATOR);

		addItem(new CheckedContextMenuItem(Settings.i18n().tr("Add Task..."),new TaskDetail()));

		addItem(new ContextMenuItem(Settings.i18n().tr("New..."),new Action()
		{
			public void handleAction(Object context) throws ApplicationException
			{
				// we force the context to be null to create a new project in any case
				new ProjectDetail().handleAction(null);
			}
		}));

		addItem(ContextMenuItem.SEPARATOR);
		addItem(new CheckedContextMenuItem(Settings.i18n().tr("Delete..."),new ProjectDelete()));

	}
}
