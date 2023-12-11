#include "crow.h"
#include <fstream>

int main()
{
    crow::SimpleApp app;

    // Route to serve the index.html file
    CROW_ROUTE(app, "/")
    ([]() {
        // Read HTML content from file
        std::ifstream t("build/static/index.html");
        if (!t.is_open()) {
            CROW_LOG_ERROR << "Failed to open HTML file!";
            return crow::response(500, "Error loading HTML file");
        }

        std::string content((std::istreambuf_iterator<char>(t)),
                            std::istreambuf_iterator<char>());

        // Return the HTML content directly
        return crow::response(content);
    });

    // Route to serve the index.html file
    CROW_ROUTE(app, "/")
    ([]() {
        // Read HTML content from file
        std::ifstream t("build/static/resume.html");
        if (!t.is_open()) {
            CROW_LOG_ERROR << "Failed to open HTML file!";
            return crow::response(500, "Error loading HTML file");
        }

        std::string content((std::istreambuf_iterator<char>(t)),
                            std::istreambuf_iterator<char>());

        // Return the HTML content directly
        return crow::response(content);
    });

    // Route to serve the index.html file
    CROW_ROUTE(app, "/")
    ([]() {
        // Read HTML content from file
        std::ifstream t("build/static/extra.html");
        if (!t.is_open()) {
            CROW_LOG_ERROR << "Failed to open HTML file!";
            return crow::response(500, "Error loading HTML file");
        }

        std::string content((std::istreambuf_iterator<char>(t)),
                            std::istreambuf_iterator<char>());

        // Return the HTML content directly
        return crow::response(content);
    });

    // Route to serve the index.html file
    CROW_ROUTE(app, "/")
    ([]() {
        // Read HTML content from file
        std::ifstream t("build/static/jobs.html");
        if (!t.is_open()) {
            CROW_LOG_ERROR << "Failed to open HTML file!";
            return crow::response(500, "Error loading HTML file");
        }

        std::string content((std::istreambuf_iterator<char>(t)),
                            std::istreambuf_iterator<char>());

        // Return the HTML content directly
        return crow::response(content);
    });

    // Route to serve the index.html file
    CROW_ROUTE(app, "/")
    ([]() {
        // Read HTML content from file
        std::ifstream t("build/static/project.html");
        if (!t.is_open()) {
            CROW_LOG_ERROR << "Failed to open HTML file!";
            return crow::response(500, "Error loading HTML file");
        }

        std::string content((std::istreambuf_iterator<char>(t)),
                            std::istreambuf_iterator<char>());

        // Return the HTML content directly
        return crow::response(content);
    });


    // Set the IP address, port, configure to run on multiple threads, and run the app
    app.loglevel(crow::LogLevel::Debug);  // Set log level to Debug
    app.bindaddr("127.0.0.1").port(18080).multithreaded().run();
}