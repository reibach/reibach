package reibach.gui.dialog;

import org.eclipse.swt.widgets.Composite;

import reibach.REIBACH;
import reibach.Settings;

import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.dialogs.AbstractDialog;
import de.willuhn.jameica.gui.input.LabelInput;
import de.willuhn.jameica.gui.parts.ButtonArea;
import de.willuhn.jameica.gui.parts.FormTextPart;
import de.willuhn.jameica.gui.util.LabelGroup;
import de.willuhn.jameica.plugin.AbstractPlugin;
import de.willuhn.jameica.system.Application;
import de.willuhn.util.ApplicationException;

/**
 * Our "About..." dialog.
 */
public class About extends AbstractDialog
{

  /**
   * ct.
   * @param position
   */
  public About(int position)
  {
    super(position);
    this.setTitle(Settings.i18n().tr("About..."));
  }

  /**
   * @see de.willuhn.jameica.gui.dialogs.AbstractDialog#paint(org.eclipse.swt.widgets.Composite)
   */
  protected void paint(Composite parent) throws Exception
  {

		FormTextPart text = new FormTextPart();
		text.setText("<form>" +
				"<p><b>Jameica Reibach plugin</b></p>" +
				"<br/>Licence: GPL (http://www.gnu.org/copyleft/gpl.html)" +
				"<br/><p>Copyright by gm [info@federa.de]</p>" +
				"<p>http://reibach-federa.de</p> .... based on" +
				"<p><b>Jameica example plugin</b></p>" +
				"<br/>Licence: GPL (http://www.gnu.org/copyleft/gpl.html)" +
				"<br/><p>Copyright by Olaf Willuhn [info@jameica.org]</p>" +
				"<p>http://www.jameica.org</p>" +
				"</form>");

		text.paint(parent);

		LabelGroup group = new LabelGroup(parent, " Information ");

		AbstractPlugin p = Application.getPluginLoader().getPlugin(REIBACH.class);

		group.addLabelPair(Settings.i18n().tr("Version"), 					new LabelInput(""+p.getManifest().getVersion()));
		group.addLabelPair(Settings.i18n().tr("Working directory"), new LabelInput(""+p.getResources().getWorkPath()));
		
		ButtonArea buttons = new ButtonArea();
		buttons.addButton(Settings.i18n().tr("Close"),new Action() {
      public void handleAction(Object context) throws ApplicationException
      {
        close();
      }
    },null,true);
		buttons.paint(parent);
		getShell().pack();

  }

  /**
   * @see de.willuhn.jameica.gui.dialogs.AbstractDialog#getData()
   */
  protected Object getData() throws Exception
  {
    return null;
  }

}
