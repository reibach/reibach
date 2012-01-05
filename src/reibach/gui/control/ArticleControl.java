package reibach.gui.control;

import java.rmi.RemoteException;

import org.eclipse.swt.widgets.Event;
import org.eclipse.swt.widgets.Listener;

import reibach.gui.menu.ArticleListMenu;
import reibach.Settings;
import reibach.rmi.Article;
import reibach.rmi.Bill;

import de.willuhn.datasource.rmi.DBIterator;
import de.willuhn.datasource.rmi.DBService;
import de.willuhn.jameica.gui.AbstractControl;
import de.willuhn.jameica.gui.AbstractView;
import de.willuhn.jameica.gui.Part;
import de.willuhn.jameica.gui.formatter.CurrencyFormatter;
import de.willuhn.jameica.gui.formatter.DateFormatter;
import de.willuhn.jameica.gui.input.DecimalInput;
import de.willuhn.jameica.gui.input.Input;
import de.willuhn.jameica.gui.input.SelectInput;
import de.willuhn.jameica.gui.input.TextAreaInput;
import de.willuhn.jameica.gui.input.TextInput;
import de.willuhn.jameica.gui.parts.TablePart;
import de.willuhn.jameica.messaging.StatusBarMessage;
import de.willuhn.jameica.system.Application;
import de.willuhn.logging.Logger;
import de.willuhn.util.ApplicationException;

/**
 * Controller for the article view.
 */
public class ArticleControl extends AbstractControl
{

	
	// list of all bills
	private TablePart articleList;
	
	  // the current article object
	private Article article;

	// the input fields for the article.
	private TextInput name;
	private TextInput unit;
	private DecimalInput price;
	private TextAreaInput comment;
  /**
   * ct.
   * @param view
   */
  public ArticleControl(AbstractView view)
  {
    super(view);
  }

	/**
	 * Returns the current article.
   * @return the article.
   */
  private Article getArticle()
	{
		if (article != null)
			return article;
		article = (Article) getCurrentObject();
		return article;
	}

	
	/**
	 * Returns an input field for the article name.
   * @return input field.
   * @throws RemoteException
   */
  public Input getName() throws RemoteException
	{
		if (name != null)
			return name;
		// "255" is the maximum length of the name attribute.
		name = new TextInput(getArticle().getName(),255);
		name.setMandatory(true);
		name.setName(Settings.i18n().tr("Article"));
		return name;
	}

  


	/**
	 * Returns an input field for the article comment.
   * @return input field.
   * @throws RemoteException
   */
  public Input getComment() throws RemoteException
	{
		if (comment != null)
			return comment;
		comment = new TextAreaInput(getArticle().getComment());
		comment.setName("");
		return comment;
	}

  
	/**
	 * Returns an input field for the task effort.
 * @return input field.
 * @throws RemoteException
 */
public Input getPrice() throws RemoteException
	{
		if (price != null)
			return price;

		// we assign our system decimal formatter
		price = new DecimalInput(getArticle().getPrice(),Settings.DECIMALFORMAT);
		price.setName(Settings.i18n().tr("Price"));
		// price.setComment(Settings.i18n().tr("Hours [example: enter \"0,5\" to store 30 minutes]"));
		return price;
	}

  
/**
 * Returns an input field for the article unit.
* @return input field.
* @throws RemoteException
*/
public Input getUnit() throws RemoteException
{
	if (unit != null)
		return unit;
	// "255" is the maximum length of the name attribute.
	unit = new TextInput(getArticle().getUnit(),255);
	unit.setName(Settings.i18n().tr("Unit"));
	return unit;
}

	/**
	 * This method stores the article using the current values. 
	 */
	public void handleStore()
	{
		try
		{

			// get the current article.
			Article t = getArticle();

			// invoke all Setters of this article and assign the current values
			t.setName((String) getName().getValue());
			t.setUnit((String) getUnit().getValue());

			// the DecimalInput fields returns a Double object
			Double d = (Double) getPrice().getValue(); 
			t.setPrice(d == null ? 0.0 : d.doubleValue());

			
			t.setComment((String) getComment().getValue());

			// Now, let's store the project
			// The store() method throws ApplicationExceptions if
			// insertCheck() or updateCheck() failed.
			try
			{
				t.store();
        Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Article stored successfully"),StatusBarMessage.TYPE_SUCCESS));
			}
			catch (ApplicationException e)
			{
        Application.getMessagingFactory().sendMessage(new StatusBarMessage(e.getMessage(),StatusBarMessage.TYPE_ERROR));
			}
		}
		catch (RemoteException e)
		{
			Logger.error("error while storing article",e);
      Application.getMessagingFactory().sendMessage(new StatusBarMessage(Settings.i18n().tr("Error while storing Article: {0}",e.getMessage()),StatusBarMessage.TYPE_ERROR));
		}
	}

	/**
	   * Creates a table containing all bills.
	   * @return a table with bills.
	   * @throws RemoteException
	   */
	  public Part getArticlesTable() throws RemoteException
	  {
	    // do we have an allready created table?
	    if (articleList != null)
	      return articleList;
	   
	    // 1) get the dataservice
	       DBService service = Settings.getDBService();
	    
	    // 2) now we can create the bill list.
	    //    We do not need to specify the implementing class for
	    //    the interface "Bill". Jameicas Classloader knows
	    //    all classes an finds the right implementation automatically. ;)
	       DBIterator articles = service.createList(Article.class);
	    
	    // 4) create the table
	     articleList = new TablePart(articles,new reibach.gui.action.ArticleDetail());

	    // 5) now we have to add some columns.
	     articleList.addColumn(Settings.i18n().tr("Name of article"),"name"); // "name" is the field name from the sql table.	
	     
	     articleList.addColumn(Settings.i18n().tr("Price"),"price"); // "preis" is the field name from the sql table.

	     articleList.addColumn(Settings.i18n().tr("Unit"),"unit"); // "unit" is the field name from the sql table.

	     /** 	    

		*/
			// 8) we are adding a context menu
	    articleList.setContextMenu(new ArticleListMenu());
	    return articleList;
	  }

	
}