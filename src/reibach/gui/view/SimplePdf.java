/**********************************************************************
 * $Source: /cvsroot/jameica/jameica_exampleplugin/src/de/willuhn/jameica/example/gui/view/BillDetail.java,v $
 * $Revision: 1.5 $
 * $Date: 2010-11-09 17:20:16 $
 * $Author: willuhn $
 * $Locker:  $
 * $State: Exp $
 *
 * Copyright (c) by willuhn.webdesign
 * All rights reserved
 *
 **********************************************************************/

package reibach.gui.view;
import java.io.*;
import reibach.Settings;
import reibach.gui.action.BillDelete;
import reibach.gui.action.PositionDetail;
import reibach.gui.control.BillControl;
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



import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.BaseFont;
import com.itextpdf.text.pdf.PdfContentByte;
import com.itextpdf.text.pdf.PdfWriter;
 

public class SimplePdf implements Action {

 public static void main(String[] args) {
   try {
     SimplePdf pdf = new SimplePdf();
     Document document = new Document();
     PdfWriter.getInstance(document,new FileOutputStream("SimplePdf.pdf"));
     document.open();
     document.add(new Paragraph(pdf.getLines()));
     document.close();
   } catch (Exception e) {
     e.printStackTrace();
   }
}

   /////////////////////////////////////////////////////

 private String getLines() throws IOException {
    BufferedReader reader = new BufferedReader(new InputStreamReader(System.in));
    StringBuffer result = new StringBuffer();
     String line;
     while((line = reader.readLine()) != null)
       result.append(line).append("n");
     return result.toString();
   }

public void handleAction(Object context) throws ApplicationException {
	// TODO Auto-generated method stub
	
}
}