package reibach.gui.view;

import reibach.Settings;
import de.willuhn.jameica.gui.AbstractView;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.jameica.gui.util.LabelGroup;
import de.willuhn.util.ApplicationException;


/**
 * Welcome screen of this reibach plugin.
 * @author willuhn
 */
public class Welcome extends AbstractView
{

  /**
   * this method will be invoked when starting the view.
   * @see de.willuhn.jameica.gui.AbstractView#bind()
	 */
	public void bind() throws Exception
	{
		GUI.getView().setTitle(Settings.i18n().tr("Reibach plugin - .... to make a big haul!"));
		
		LabelGroup group = new LabelGroup(this.getParent(),Settings.i18n().tr("welcome"));
		
		group.addText(Settings.i18n().tr("Moin, da geit wat.)"),false);

	}

  /**
   * this method will be executed when exiting the view.
   * You don't need to dispose your widgets, the GUI controller will
   * do this in a recursive way for you.
   * @see de.willuhn.jameica.gui.AbstractView#unbind()
	 */
	public void unbind() throws ApplicationException
	{
    // We've nothing to do here ;)
	}

}
