#include "cube.h"
#include "../framework/debug.h"

Cube::Cube(Shader &shader, glm::vec3 pos, glm::vec3 size, struct color color) {
    this->shader = shader;
    this->pos = pos;
    this->size = size;
    this->color = color;

    this->initVectors();
    this->initVAO();
    this->initVBO();
    this->initEBO();
}

Cube::~Cube() {
    glDeleteVertexArrays(1, &this->VAO);
    glDeleteBuffers(1, &VBO);
    glDeleteBuffers(1, &EBO);
}

void Cube::setUniforms(const glm::mat4 &model, const glm::mat4 &view, const glm::mat4 &projection) const {
    this->shader.setMatrix4("model", model);
    this->shader.setMatrix4("view", view);
    this->shader.setMatrix4("projection", projection);
}

void Cube::draw(const mat4& model, const mat4& view, const mat4& projection) const {
    glBindVertexArray(this->VAO);
    glDrawElements(GL_TRIANGLES, 36, GL_UNSIGNED_INT, 0);
    glBindVertexArray(0);
}

void Cube::initVectors() {
    this->vertices.insert(this->vertices.end(), {
            // Each row contains x, y, z, r, g, b values for position and color
            // Front face
             0.5f,  0.5f,  0.5f, 0.0f, 0.0f, 1.0f, // Top right, blue
            -0.5f,  0.5f,  0.5f, 1.0f, 1.0f, 0.0f, // Top left, yellow
             0.5f, -0.5f,  0.5f, 0.0f, 1.0f, 0.0f, // Bottom right, green
            -0.5f, -0.5f,  0.5f, 1.0f, 0.0f, 0.0f, // Bottom left, red
            // TODO: add vertices for the back face
            // Back face
            // Top right, white
            // Top left, gray
            // Bottom right, cyan
            // Bottom left, magenta
    });

    this->indices.insert(this->indices.end(), {
        // Each face lists the indices of the vertices as two triangles
        // TODO: complete the other five faces
            // Front face
            0, 1, 2,
            2, 3, 1,
            // Right face
            // Back face
            // Left face
            // Bottom face
            // Top face
    });
}

void Cube::initVAO() {
    glGenVertexArrays(1, &this->VAO);
    glBindVertexArray(this->VAO);
}

void Cube::initVBO() {
    glGenBuffers(1, &this->VBO);
    glBindBuffer(GL_ARRAY_BUFFER, this->VBO);
    glBufferData(GL_ARRAY_BUFFER, this->vertices.size() * sizeof(float), vertices.data(), GL_STATIC_DRAW);

    // Position attribute
    glVertexAttribPointer(0, 3, GL_FLOAT, GL_FALSE, 6 * sizeof(float), nullptr);
    glEnableVertexAttribArray(0);

    // Color attribute (3 floats)
    glVertexAttribPointer(1, 3, GL_FLOAT, GL_FALSE, 6 * sizeof(float), (void*)(3 * sizeof(float)));
    glEnableVertexAttribArray(1);
}

void Cube::initEBO() {
    glGenBuffers(1, &this->EBO);
    glBindBuffer(GL_ELEMENT_ARRAY_BUFFER, this->EBO);
    glBufferData(GL_ELEMENT_ARRAY_BUFFER, this->indices.size() * sizeof(unsigned int), indices.data(), GL_STATIC_DRAW);
}