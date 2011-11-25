package reibach.gui.view;

import java.io.FileOutputStream;
import java.io.IOException;
 
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.PdfWriter;


public class PdfPrint {
   public boolean createPDF() {
      Document document = new Document();
      try {
         // Writer Instanz erstellen
         PdfWriter.getInstance(document,new FileOutputStream("/tmp/hw.pdf"));
         // step 3: Dokument öffnen
         document.open();
         // step 4: Absatz mit Text dem Dokument hinzufügen
         document.add(new Paragraph("Hello World"));
      } catch (DocumentException de) {
         System.err.println(de.getMessage());
      } catch (IOException ioe) {
         System.err.println(ioe.getMessage());
      }
 
      // step 5: Dokument schließen
      document.close();
      return true;
   }
}
