/**********************************************************************
 * $Source: /cvsroot/jameica/jameica_exampleplugin/src/de/willuhn/jameica/example/gui/action/BillList.java,v $
 * $Revision: 1.3 $
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

import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.util.ApplicationException;

/*
 * Action to open the project list.
 */
public class BillList implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {
  	GUI.startView(reibach.gui.view.BillList.class.getName(),null);
  }

}


/**********************************************************************
 * $Log: ProjectList.java,v $
 * Revision 1.3  2010-11-09 17:20:15  willuhn
 * @N Beispiel-Plugin auf aktuellen Stand gebracht. Code-Cleanup und Beispiel-Implementierung fuer Search-API hinzugefuegt
 *
 **********************************************************************/