package reibach.gui.action;

import java.rmi.RemoteException;

import reibach.Settings;
import reibach.rmi.Article;

import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.util.ApplicationException;

/**
 * Action for "show Article details" or "create new Article".
 */
public class ArticleDetail implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {

		Article a = null;
		
		// check if the context is a article
		if (context != null && (context instanceof Article))
			a = (Article) context;
		
		else
		{	
			try
			{
				a = (Article) Settings.getDBService().createObject(Article.class,null);
			}
			catch (RemoteException e)
			{
				throw new ApplicationException(Settings.i18n().tr("error while creating new article"),e);
			}
		}

	
		// ok, lets start the dialog
  		GUI.startView(reibach.gui.view.ArticleDetail.class.getName(),a);
  }

}
