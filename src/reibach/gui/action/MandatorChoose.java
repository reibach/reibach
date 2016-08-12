package reibach.gui.action;

import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.util.ApplicationException;

/*
 * Action to open the mandator list.
 */
public class MandatorChoose implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {
  	GUI.startView(reibach.gui.view.MandatorChoose.class.getName(),null);
  }

}
