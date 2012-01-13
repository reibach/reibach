package reibach.gui.view;

import reibach.gui.action.ArticleDelete;
import reibach.gui.control.ArticleControl;
import reibach.Settings;
import de.willuhn.jameica.gui.AbstractView;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.jameica.gui.internal.buttons.Back;
import de.willuhn.jameica.gui.parts.ButtonArea;
import de.willuhn.jameica.gui.util.ColumnLayout;
import de.willuhn.jameica.gui.util.Container;
import de.willuhn.jameica.gui.util.SimpleContainer;
import de.willuhn.util.ApplicationException;

/**
 * Detail view for articles.
 */
public class ArticleDetail extends AbstractView
{

  /**
   * @see de.willuhn.jameica.gui.AbstractView#bind()
   */
  public void bind() throws Exception
  {
		// draw the title
		GUI.getView().setTitle(Settings.i18n().tr("Article details"));

		// instanciate controller
		final ArticleControl control = new ArticleControl(this);
    
		Container c = new SimpleContainer(getParent());
		
    // layout with 2 columns
    ColumnLayout columns = new ColumnLayout(c.getComposite(),2);

    // left side
    Container left = new SimpleContainer(columns.getComposite());
    left.addHeadline(Settings.i18n().tr("Details"));
	// left.addInput(control.getProject());
	left.addInput(control.getName());
	left.addInput(control.getPrice());
	left.addInput(control.getUnit());

    // right side
    Container right = new SimpleContainer(columns.getComposite(),true);
    right.addHeadline(Settings.i18n().tr("Description - will not be printed"));
    right.addInput(control.getComment());

		// add some buttons
		ButtonArea buttons = new ButtonArea();

		buttons.addButton(new Back());
		buttons.addButton(Settings.i18n().tr("Delete"), new ArticleDelete(),control.getCurrentObject());
		buttons.addButton(Settings.i18n().tr("Store"),  new Action()
		{
			public void handleAction(Object context) throws ApplicationException
			{
				control.handleStore();
			}
		},null,true); // "true" defines this button as the default button

		// Don't forget to paint the button area
    buttons.paint(getParent());
  }
}

