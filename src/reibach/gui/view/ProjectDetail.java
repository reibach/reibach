package reibach.gui.view;

import reibach.Settings;
import reibach.gui.action.ProjectDelete;
import reibach.gui.action.TaskDetail;
import reibach.gui.control.ProjectControl;
import de.willuhn.jameica.gui.AbstractView;
import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.jameica.gui.internal.buttons.Back;
import de.willuhn.jameica.gui.parts.ButtonArea;
import de.willuhn.jameica.gui.util.ColumnLayout;
import de.willuhn.jameica.gui.util.Container;
import de.willuhn.jameica.gui.util.Headline;
import de.willuhn.jameica.gui.util.SimpleContainer;
import de.willuhn.util.ApplicationException;


/**
 * this is the dialog for the project details. 
 */
public class ProjectDetail extends AbstractView
{

	/**
   * @see de.willuhn.jameica.gui.AbstractView#bind()
   */
	public void bind() throws Exception
	{
    // draw the title
		GUI.getView().setTitle(Settings.i18n().tr("Project details"));

    // instanciate controller
    final ProjectControl control = new ProjectControl(this);

    Container c = new SimpleContainer(getParent());

    // layout with 2 columns
    ColumnLayout columns = new ColumnLayout(c.getComposite(),2);

    // left side
    Container left = new SimpleContainer(columns.getComposite());
    left.addHeadline(Settings.i18n().tr("Details"));
    left.addInput(control.getName());
    left.addInput(control.getPrice());
    left.addInput(control.getStartDate());
    left.addInput(control.getEndDate());
    
    // right side
    Container right = new SimpleContainer(columns.getComposite(),true);
    right.addHeadline(Settings.i18n().tr("Description"));
    right.addInput(control.getDescription());
    
    c.addHeadline(Settings.i18n().tr("Summary"));
		c.addInput(control.getEffortSummary());

    // add some buttons
    ButtonArea buttons = new ButtonArea();
    buttons.addButton(new Back());
    buttons.addButton(Settings.i18n().tr("New Task"), new TaskDetail(),control.getCurrentObject());
    buttons.addButton(Settings.i18n().tr("Delete"),  	new ProjectDelete(),control.getCurrentObject());
    buttons.addButton(Settings.i18n().tr("Store"),   	new Action()
    {
      public void handleAction(Object context) throws ApplicationException
      {
        control.handleStore();
      }
    },null,true); // "true" defines this button as the default button

    // Don't forget to paint the button area
    buttons.paint(getParent());

		// show task tasks in this project
		new Headline(getParent(),Settings.i18n().tr("Tasks within this project"));
		control.getTaskList().paint(getParent());
	}

	/**
   * @see de.willuhn.jameica.gui.AbstractView#unbind()
   */
  public void unbind() throws ApplicationException
	{
    // this method will be invoked when leaving the dialog.
    // You are able to interrupt the unbind by throwing an
    // ApplicationException.
	}

}

