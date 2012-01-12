package reibach.gui.action;

import java.rmi.RemoteException;

import reibach.Settings;
import reibach.rmi.Bill;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.util.ApplicationException;

/**
 * Action for "show bill details" or "create new Bill".
 */
public class BillDetail implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {

		Bill p = null;

		// check if the context is a bill
  	if (context != null && (context instanceof Bill))
  	{
      p = (Bill) context;
  	}
		else
		{
			try
			{
			  // create new bill
				p = (Bill) Settings.getDBService().createObject(Bill.class,null);
			}
			catch (RemoteException e)
			{
				throw new ApplicationException(Settings.i18n().tr("error while creating new bill"),e);
			}
		}

		// ok, lets start the dialog
  	GUI.startView(reibach.gui.view.BillDetail.class.getName(),p);
  }
}
