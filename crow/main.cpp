#include "crow.h"
#include <fstream>
#include "opencv2.framework/Headers/opencv.hpp"
#include "opencv2.framework"

int main() {
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

    // Route to serve the resume.html file
    CROW_ROUTE(app, "/resume")
    ([]() {
        std::ifstream t("build/static/resume.html");
        if (!t.is_open()) {
            CROW_LOG_ERROR << "Failed to open HTML file!";
            return crow::response(500, "Error loading HTML file");
        }

        std::string content((std::istreambuf_iterator<char>(t)),
                            std::istreambuf_iterator<char>());

        return crow::response(content);
    });

    // Route to serve the extra.html file
    CROW_ROUTE(app, "/extra")
    ([]() {
        std::ifstream t("build/static/extra.html");
        if (!t.is_open()) {
            CROW_LOG_ERROR << "Failed to open HTML file!";
            return crow::response(500, "Error loading HTML file");
        }

        std::string content((std::istreambuf_iterator<char>(t)),
                            std::istreambuf_iterator<char>());

        return crow::response(content);
    });

    // Route to serve the jobs.html file
    CROW_ROUTE(app, "/jobs")
    ([]() {
        std::ifstream t("build/static/jobs.html");
        if (!t.is_open()) {
            CROW_LOG_ERROR << "Failed to open HTML file!";
            return crow::response(500, "Error loading HTML file");
        }

        std::string content((std::istreambuf_iterator<char>(t)),
                            std::istreambuf_iterator<char>());

        return crow::response(content);
    });

    // Route to serve the project.html file
    CROW_ROUTE(app, "/project")
    ([]() {
        std::ifstream t("build/static/project.html");
        if (!t.is_open()) {
            CROW_LOG_ERROR << "Failed to open HTML file!";
            return crow::response(500, "Error loading HTML file");
        }

        std::string content((std::istreambuf_iterator<char>(t)),
                            std::istreambuf_iterator<char>());

        return crow::response(content);
    });


    // Set the IP address, port, configure to run on multiple threads, and run the app
    app.loglevel(crow::LogLevel::Debug);  // Set log level to Debug
    app.bindaddr("127.0.0.1").port(18080).multithreaded().run();
}
