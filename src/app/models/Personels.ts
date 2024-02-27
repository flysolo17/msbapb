export interface Personels {
  id: number;
  name: string;
  photo: string | null;
  position: string | null;
  type: string;
  contact: string;
  active: number;
}

const storage = 'http://localhost/msbapb/api/uploads/';

export const PersonelsConverter = {
  toJson: (person: Personels): string => {
    return JSON.stringify(person);
  },
  fromJson: (json: any): Personels => {
    const { id, name, photo, position, type, contact, active } = json;
    const image = photo ? storage + photo : null;
    return { id, name, photo: image, position, type, contact, active };
  },
};
