export interface Administrator {
  id: number;
  office: string;
  name: string;
  photo: string | null;
  type: number;
  email: string;
}
const storage = 'https://danica.msbapb.com/api/uploads/';
export const AdministratorConverter = {
  toJson: (admin: Administrator): string => {
    return JSON.stringify(admin);
  },
  fromJson: (json: any): Administrator => {
    const { id, office, name, photo, type, email } = json;
    const image = photo ? storage + photo : null;
    return {
      id: id,
      office: office,
      name: name,
      photo: image,
      type: type,
      email: email,
    };
  },
};
