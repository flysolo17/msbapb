import { Injectable } from '@angular/core';

import * as pdfMake from 'pdfmake/build/pdfmake';
import * as pdfFonts from 'pdfmake/build/vfs_fonts';
import { PageOrientation, TDocumentDefinitions } from 'pdfmake/interfaces';
import { Incidents } from '../models/Incidents';
import { ReporterToString } from '../models/Reporter';

(<any>pdfMake).vfs = pdfFonts.pdfMake.vfs;

@Injectable({
  providedIn: 'root',
})
export class PrintingService {
  constructor() {}

  private async getImageDataUrl(imagePath: string): Promise<string> {
    const response = await fetch(imagePath);
    const blob = await response.blob();
    return new Promise((resolve, reject) => {
      const reader = new FileReader();
      reader.onloadend = () => resolve(reader.result as string);
      reader.onerror = reject;
      reader.readAsDataURL(blob);
    });
  }

  async downloadPDF(name: string, data: Incidents[]) {
    const logoImagePath = 'assets/images/logo.png';
    const logoImageDataURL = await this.getImageDataUrl(logoImagePath);
    const documentDefinition: TDocumentDefinitions = {
      pageOrientation: 'landscape' as PageOrientation,
      content: [
        // Content for the Left Column
        {
          columns: [
            // Left Column
            {
              width: 'auto',
              stack: [
                { text: 'MSBAPB', bold: true },
                'Binalonan Pangasinan',
                'capstone.danica@msbapb.com',
                '0963187114',
                '\n',
                { text: `Printed by: ${name}` },
                { text: `Printed At: ${new Date().toLocaleString()}` },
                '\n',
              ],
            },
            // Right Column (Logo)
            {
              width: '*', // Take the remaining space
              stack: [
                {
                  image: logoImageDataURL,
                  width: 75,
                  absolutePosition: { x: 700, y: 20 },
                },
              ],
            },
          ],
        },

        {
          table: {
            headerRows: 1,

            body: [
              [
                'ID',
                'DESC',
                'LOCATION',
                'SEVERITY',
                'STATUS',
                'REPORTER',
                'TIMESTAMP',
              ],
              ...data.map((element) => [
                element.id,
                element.description,
                element.location,
                element.severity,
                element.status,
                ReporterToString(element.reporter),
                element.incident_date,
              ]),
            ],
          },
        },
      ],
    };

    pdfMake
      .createPdf(documentDefinition)
      .download(
        `Incidents - ${new Date().toLocaleString().replace(/\//g, '-')}.pdf`
      );
  }
}
