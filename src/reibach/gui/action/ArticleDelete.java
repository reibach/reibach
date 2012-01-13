package reibach.gui.action;

import reibach.Settings;
import reibach.rmi.Article;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.messaging.StatusBarMessage;
import de.willuhn.jameica.system.Application;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;

/**
 * Action for "delete article".
 */
public class ArticleDelete implements Action
{

  /**
   * @see de.willuhn.jameica.gui.Action#handleAction(java.lang.Object)
   */
  public void handleAction(Object context) throws ApplicationException
  {

		// check if the context is a project
  	if (context == null || !(context instanceof Article))
  		throw new ApplicationException(Settings.i18n().tr("Please choose a article you want to delete"));

    Article t = (Article) context;
    
    try
    {

			// before deleting the article, we show up a confirm dialog ;)
      // before deleting the project, we show up a confirm dialog ;)
      String question = Settings.i18n().tr("Do you really want to delete this article?");
      if (!Application.getCallback().askUser(question))
        return;
			
      t.delete();
      // Send Status update message
      Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Article deleted successfully"),StatusBarMessage.TYPE_SUCCESS));
    }
    catch (Exception e)
    {
      Logger.error("error while deleting article",e);
      throw new ApplicationException(Settings.i18n().tr("Error while deleting article"));
    }
  }

}

