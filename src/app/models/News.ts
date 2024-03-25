export interface News {
  id: number;
  photo: string;
  title: string;
  description: string;
  link: string;
  type: string;
  createdAt: string; // Add createdAt property to News interface
}

const storage = 'https://danica.msbapb.com/api/uploads/';

export const NewsConverter = {
  toJson: (news: News): string => {
    return JSON.stringify(news);
  },
  fromJson: (json: any): News => {
    const { id, photo, title, description, link, type, createdAt } = json;
    const image = photo ? storage + photo : '';
    return { id, photo: image, title, description, link, type, createdAt }; // Include createdAt in the returned object
  },
};
