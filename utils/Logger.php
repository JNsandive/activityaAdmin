<?php

class Logger {
    private const BASE_DIR = __DIR__ . '/../logs/';
    private const ERROR_LOG = 'error.log';
    private const INFO_LOG = 'info.log';

    /**
     * Log an error message
     */
    public static function error(string $context, string $message): void {
        self::writeLog(self::ERROR_LOG, $context, $message);
    }

    /**
     * Log an informational message
     */
    public static function info(string $context, string $message): void {
        self::writeLog(self::INFO_LOG, $context, $message);
    }

    /**
     * Internal method to write logs to file
     */
    private static function writeLog(string $fileName, string $context, string $message): void {
        $filePath = self::BASE_DIR . $fileName;
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[{$timestamp}] [{$context}] {$message}\n";
        file_put_contents($filePath, $logEntry, FILE_APPEND);
    }
}
