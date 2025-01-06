-- Insert roles
INSERT INTO roles (role_name) VALUES
                                  ('Admin'),
                                  ('Client');

-- Insert users
INSERT INTO users (nom, prenom, email, password, fk_role_id) VALUES
                                                                 ('Doe', 'John', 'john.doe@example.com', 'password123', 1), -- Admin
                                                                 ('Smith', 'Jane', 'jane.smith@example.com', 'password456', 2), -- Client
                                                                 ('Brown', 'Charlie', 'charlie.brown@example.com', 'password789', 2), -- Client
                                                                 ('Taylor', 'Alex', 'alex.taylor@example.com', 'adminpass', 1); -- Admin

-- Insert categories
INSERT INTO categories (categorie_nom) VALUES
                                                       ('SUV'),
                                                       ('Sedan'),
                                                       ('Truck'),
                                                       ('Electric');

-- Insert vehicules
INSERT INTO vehicules (vehicule_prix, vehicule_disponibilite, vehicule_marque, vehicule_modele, vehicule_annee, fk_user_id, fk_categorie_id) VALUES
                                                                                                                                                 (25000.00, 'Available', 'Toyota', 'RAV4', 2022, 2, 1),
                                                                                                                                                 (22000.00, 'NonAvailable', 'Honda', 'Civic', 2021, 3, 2),
                                                                                                                                                 (28000.00, 'Available', 'Ford', 'F-150', 2023, 3, 3),
                                                                                                                                                 (35000.00, 'Available', 'Tesla', 'Model 3', 2024, 4, 4);

-- Insert reservations
INSERT INTO reservation (reservation_status, reservation_date, reservation_lieux, fk_user_id, fk_vehicule_id) VALUES
                                                                                                                  ('Pending', '2025-01-10', 'Paris', 2, 1),
                                                                                                                  ('Approuve', '2025-01-12', 'Lyon', 3, 2),
                                                                                                                  ('Reject', '2025-01-15', 'Marseille', 3, 3),
                                                                                                                  ('Pending', '2025-01-18', 'Nice', 4, 4);

-- Insert avis (feedback)
INSERT INTO avis (avis_rating, fk_user_id, fk_vehicule_id, is_deleted) VALUES
                                                                           (4, 2, 1, FALSE),
                                                                           (5, 3, 2, FALSE),
                                                                           (3, 3, 3, FALSE),
                                                                           (5, 4, 4, TRUE);
