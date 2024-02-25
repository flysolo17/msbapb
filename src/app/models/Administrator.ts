export interface Administrator {
  id: number;
  office: string;
  name: string;
  photo: string | null;
  type: number;
  email: string;
}
export const AdministratorConverter = {
  toJson: (admin: Administrator): string => {
    return JSON.stringify(admin);
  },
  fromJson: (json: any): Administrator => {
    const { id, office, name, photo, type, email } = json;

    return {
      id: id,
      office: office,
      name: name,
      photo: photo,
      type: type,
      email: email,
    };
  },
};
