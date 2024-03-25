export interface Reporter {
  fullname: string;
  contact: string;
  email: string;
}
export const ReporterToString = (reporter: Reporter): string => {
  return `Fullname: ${reporter.fullname}\nContact: ${reporter.contact}\nEmail: ${reporter.email}`;
};
