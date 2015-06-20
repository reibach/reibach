package reibach.gui.action;

import java.rmi.RemoteException;

import reibach.Settings;
import reibach.rmi.Article;

import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.util.ApplicationException;

/**
 * Action for "duplicate Article".
 */
public class ArticleDuplicate implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {

		if (context == null || !(context instanceof Article))
			throw new ApplicationException(Settings.i18n().tr("Please a article you want to duplicate"));

		Article article = null;
		try
		{
			// Lets create a new Article
			article = (Article) Settings.getDBService().createObject(Article.class,null);
		
			// copy the attributes into the new object.
			article.overwrite((Article)context);
		}
		catch (RemoteException e)
		{
			throw new ApplicationException(Settings.i18n().tr("Error while duplicating the article"),e);
		}

		// ok, lets start the dialog 
  	GUI.startView(reibach.gui.view.ArticleDetail.class.getName(),article);
  }

}


