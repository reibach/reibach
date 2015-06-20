package reibach.io;

import java.io.FileOutputStream;
import java.io.IOException;
import java.io.File;
import java.io.OutputStream;
import java.rmi.RemoteException;
import java.util.Date;

import reibach.Settings;
import reibach.rmi.Bill;
 
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.PdfWriter;

import de.willuhn.jameica.gui.Action;
import de.willuhn.jameica.gui.GUI;
import de.willuhn.util.ApplicationException;



 
/**
 * First iText example: Hello World.
 */
public class PdfPrint implements Action {
 
	 public void handleAction(Object context) throws ApplicationException
	  { 
		 
		 try {
            OutputStream file = new FileOutputStream(new File("/tmp/Test.pdf"));
 
            Document document = new Document();
            PdfWriter.getInstance(document, file);
            document.open();
            document.add(new Paragraph("Hallo Michi"));
            document.add(new Paragraph(new Date().toString()));
 
            document.close();
            file.close();
 
        } catch (Exception e) {
				throw new ApplicationException(Settings.i18n().tr("error while creating new bill"),e);
			}

        }
    }


