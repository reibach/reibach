package reibach.gui.view;

import reibach.Settings;
import reibach.gui.action.ProjectDetail;
import reibach.gui.control.ProjectControl;
import de.willuhn.jameica.gui.AbstractView;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.jameica.gui.internal.buttons.Back;
import de.willuhn.jameica.gui.parts.ButtonArea;

/**
 * View to show the list of existing projects.
 */
public class ProjectList extends AbstractView
{

  /**
   * @see de.willuhn.jameica.gui.AbstractView#bind()
   */
  public void bind() throws Exception {

		GUI.getView().setTitle(Settings.i18n().tr("Existing projects"));
		
		ProjectControl control = new ProjectControl(this);
		
		control.getProjectsTable().paint(this.getParent());
		
		ButtonArea buttons = new ButtonArea();
    buttons.addButton(new Back());
		
		// the last parameter "true" makes the button the default one
		buttons.addButton(Settings.i18n().tr("Create new project"), new ProjectDetail(),null,true);
		
		buttons.paint(getParent());
		
  }
}


