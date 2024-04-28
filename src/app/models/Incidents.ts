import { Reporter } from './Reporter';

export interface Incidents {
  id: number;

  photo: string;
  status: string;
  location: string;
  type: string;
  description: string;

  severity: string;
  incident_date: string;
  reporter: Reporter;
  respondents: string | null;
  latitude: number | null;
  longitude: number | null;
}

export const IncidentConverter = {
  toJson: (incidents: Incidents): string => {
    return JSON.stringify(incidents);
  },
  fromJson: (json: any): Incidents => {
    return {
      id: json.id,

      photo: json.photo,
      status: json.status,
      location: json.location,
      type: json.type,
      description: json.description,
      severity: json.severity,
      incident_date: json.incident_date,
      respondents: json.respondents,
      reporter: {
        fullname: json.reporter.fullname,
        contact: json.reporter.contact,
        email: json.reporter.email,
      },
      latitude: json.latitude,
      longitude: json.longitude,
    };
  },
};
